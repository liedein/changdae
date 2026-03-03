import type { Express } from "express";
import type { Server } from "http";
import { storage } from "./storage";
import { api } from "@shared/routes";
import { z } from "zod";
import session from "express-session";
import MemoryStore from "memorystore";

const SessionStore = MemoryStore(session);

export async function registerRoutes(httpServer: Server, app: Express): Promise<Server> {
  app.use(
    session({
      secret: process.env.SESSION_SECRET || "super-secret-admin-key",
      resave: false,
      saveUninitialized: false,
      store: new SessionStore({ checkPeriod: 86400000 }),
      cookie: { secure: process.env.NODE_ENV === "production" },
    })
  );

  const requireAdmin = (req: any, res: any, next: any) => {
    if (req.session?.adminLoggedIn) {
      next();
    } else {
      res.status(401).json({ message: "Unauthorized" });
    }
  };

  // Admin Auth
  app.post(api.admin.login.path, async (req, res) => {
    try {
      const { username, password } = api.admin.login.input.parse(req.body);
      // Fixed admin credentials for MVP
      if (username === "admin" && password === "admin123") {
        (req.session as any).adminLoggedIn = true;
        res.json({ message: "Logged in successfully" });
      } else {
        res.status(401).json({ message: "Invalid credentials" });
      }
    } catch (err) {
      res.status(400).json({ message: "Invalid request" });
    }
  });

  app.post(api.admin.logout.path, (req, res) => {
    req.session.destroy(() => {
      res.json({ message: "Logged out" });
    });
  });

  app.get(api.admin.me.path, (req, res) => {
    if ((req.session as any)?.adminLoggedIn) {
      res.json({ loggedIn: true });
    } else {
      res.status(401).json({ message: "Unauthorized", loggedIn: false });
    }
  });

  // Bulletins
  app.get(api.bulletins.list.path, async (req, res) => {
    const data = await storage.getBulletins();
    res.json(data);
  });
  app.post(api.bulletins.create.path, requireAdmin, async (req, res) => {
    try {
      const input = api.bulletins.create.input.parse(req.body);
      const data = await storage.createBulletin(input);
      res.status(201).json(data);
    } catch (err) {
      if (err instanceof z.ZodError) return res.status(400).json({ message: err.errors[0].message });
      throw err;
    }
  });
  app.delete(api.bulletins.delete.path, requireAdmin, async (req, res) => {
    await storage.deleteBulletin(Number(req.params.id));
    res.status(204).send();
  });

  // News
  app.get(api.news.list.path, async (req, res) => {
    const data = await storage.getNews();
    res.json(data);
  });
  app.post(api.news.create.path, requireAdmin, async (req, res) => {
    try {
      const input = api.news.create.input.parse(req.body);
      const data = await storage.createNews(input);
      res.status(201).json(data);
    } catch (err) {
      if (err instanceof z.ZodError) return res.status(400).json({ message: err.errors[0].message });
      throw err;
    }
  });
  app.delete(api.news.delete.path, requireAdmin, async (req, res) => {
    await storage.deleteNews(Number(req.params.id));
    res.status(204).send();
  });

  // Columns
  app.get(api.columns.list.path, async (req, res) => {
    const data = await storage.getColumns();
    res.json(data);
  });
  app.post(api.columns.create.path, requireAdmin, async (req, res) => {
    try {
      const input = api.columns.create.input.parse(req.body);
      const data = await storage.createColumn(input);
      res.status(201).json(data);
    } catch (err) {
      if (err instanceof z.ZodError) return res.status(400).json({ message: err.errors[0].message });
      throw err;
    }
  });
  app.delete(api.columns.delete.path, requireAdmin, async (req, res) => {
    await storage.deleteColumn(Number(req.params.id));
    res.status(204).send();
  });

  // Sermons
  app.get(api.sermons.list.path, async (req, res) => {
    const data = await storage.getSermons();
    res.json(data);
  });
  app.post(api.sermons.create.path, requireAdmin, async (req, res) => {
    try {
      const input = api.sermons.create.input.parse(req.body);
      const data = await storage.createSermon(input);
      res.status(201).json(data);
    } catch (err) {
      if (err instanceof z.ZodError) return res.status(400).json({ message: err.errors[0].message });
      throw err;
    }
  });
  app.delete(api.sermons.delete.path, requireAdmin, async (req, res) => {
    await storage.deleteSermon(Number(req.params.id));
    res.status(204).send();
  });

  // Seed data
  seedDatabase().catch(console.error);

  return httpServer;
}

async function seedDatabase() {
  const newsData = await storage.getNews();
  if (newsData.length === 0) {
    await storage.createNews({
      title: "환영합니다! 창대교회 새 홈페이지가 오픈되었습니다.",
      content: "창대교회의 새로운 홈페이지를 통해 성도님들과 더 깊이 소통하길 소망합니다.",
    });
    await storage.createSermon({
      title: "하나님의 은혜",
      passage: "요한복음 3:16",
      preacher: "이대비 목사",
      videoUrl: "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
      sermonDate: new Date().toISOString().split('T')[0],
    });
    await storage.createBulletin({
      title: "2024년 10월 첫째주 주보",
      imageUrls: ["https://images.unsplash.com/photo-1438032005730-c779502df39b?q=80&w=2071&auto=format&fit=crop"],
    });
    await storage.createColumn({
      title: "목회 단상 - 가을을 맞이하며",
      content: "결실의 계절 가을입니다. 우리 삶에도 풍성한 열매가 맺히기를 기도합니다.",
    });
  }
}
