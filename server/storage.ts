import { db } from "./db";
import {
  bulletins, news, columns, sermons,
  type InsertBulletin, type InsertNews, type InsertColumn, type InsertSermon,
  type Bulletin, type News, type Column, type Sermon
} from "@shared/schema";
import { eq, desc, lte, and } from "drizzle-orm";

export interface IStorage {
  // Bulletins
  getBulletins(isAdmin?: boolean): Promise<Bulletin[]>;
  createBulletin(bulletin: InsertBulletin): Promise<Bulletin>;
  deleteBulletin(id: number): Promise<void>;
  
  // News
  getNews(isAdmin?: boolean): Promise<News[]>;
  createNews(item: InsertNews): Promise<News>;
  deleteNews(id: number): Promise<void>;

  // Columns
  getColumns(isAdmin?: boolean): Promise<Column[]>;
  createColumn(item: InsertColumn): Promise<Column>;
  deleteColumn(id: number): Promise<void>;

  // Sermons
  getSermons(isAdmin?: boolean): Promise<Sermon[]>;
  createSermon(item: InsertSermon): Promise<Sermon>;
  deleteSermon(id: number): Promise<void>;
}

export class DatabaseStorage implements IStorage {
  private todayStr() {
    return new Date().toISOString().split('T')[0];
  }

  // Bulletins
  async getBulletins(isAdmin = false): Promise<Bulletin[]> {
    const query = isAdmin 
      ? db.select().from(bulletins)
      : db.select().from(bulletins).where(lte(bulletins.publishDate, this.todayStr()));
    return await query.orderBy(desc(bulletins.publishDate), desc(bulletins.id));
  }
  async createBulletin(item: InsertBulletin): Promise<Bulletin> {
    const [created] = await db.insert(bulletins).values(item).returning();
    return created;
  }
  async deleteBulletin(id: number): Promise<void> {
    await db.delete(bulletins).where(eq(bulletins.id, id));
  }

  // News
  async getNews(isAdmin = false): Promise<News[]> {
    const query = isAdmin
      ? db.select().from(news)
      : db.select().from(news).where(lte(news.publishDate, this.todayStr()));
    return await query.orderBy(desc(news.publishDate), desc(news.id));
  }
  async createNews(item: InsertNews): Promise<News> {
    const [created] = await db.insert(news).values(item).returning();
    return created;
  }
  async deleteNews(id: number): Promise<void> {
    await db.delete(news).where(eq(news.id, id));
  }

  // Columns
  async getColumns(isAdmin = false): Promise<Column[]> {
    const query = isAdmin
      ? db.select().from(columns)
      : db.select().from(columns).where(lte(columns.publishDate, this.todayStr()));
    return await query.orderBy(desc(columns.publishDate), desc(columns.id));
  }
  async createColumn(item: InsertColumn): Promise<Column> {
    const [created] = await db.insert(columns).values(item).returning();
    return created;
  }
  async deleteColumn(id: number): Promise<void> {
    await db.delete(columns).where(eq(columns.id, id));
  }

  // Sermons
  async getSermons(isAdmin = false): Promise<Sermon[]> {
    const query = isAdmin
      ? db.select().from(sermons)
      : db.select().from(sermons).where(lte(sermons.publishDate, this.todayStr()));
    return await query.orderBy(desc(sermons.publishDate), desc(sermons.id));
  }
  async createSermon(item: InsertSermon): Promise<Sermon> {
    const [created] = await db.insert(sermons).values(item).returning();
    return created;
  }
  async deleteSermon(id: number): Promise<void> {
    await db.delete(sermons).where(eq(sermons.id, id));
  }
}

export const storage = new DatabaseStorage();
