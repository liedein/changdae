import { db } from "./db";
import {
  bulletins, news, columns, sermons,
  type InsertBulletin, type InsertNews, type InsertColumn, type InsertSermon,
  type Bulletin, type News, type Column, type Sermon
} from "@shared/schema";
import { eq, desc } from "drizzle-orm";

export interface IStorage {
  // Bulletins
  getBulletins(): Promise<Bulletin[]>;
  createBulletin(bulletin: InsertBulletin): Promise<Bulletin>;
  deleteBulletin(id: number): Promise<void>;
  
  // News
  getNews(): Promise<News[]>;
  createNews(item: InsertNews): Promise<News>;
  deleteNews(id: number): Promise<void>;

  // Columns
  getColumns(): Promise<Column[]>;
  createColumn(item: InsertColumn): Promise<Column>;
  deleteColumn(id: number): Promise<void>;

  // Sermons
  getSermons(): Promise<Sermon[]>;
  createSermon(item: InsertSermon): Promise<Sermon>;
  deleteSermon(id: number): Promise<void>;
}

export class DatabaseStorage implements IStorage {
  // Bulletins
  async getBulletins(): Promise<Bulletin[]> {
    return await db.select().from(bulletins).orderBy(desc(bulletins.id));
  }
  async createBulletin(item: InsertBulletin): Promise<Bulletin> {
    const [created] = await db.insert(bulletins).values(item).returning();
    return created;
  }
  async deleteBulletin(id: number): Promise<void> {
    await db.delete(bulletins).where(eq(bulletins.id, id));
  }

  // News
  async getNews(): Promise<News[]> {
    return await db.select().from(news).orderBy(desc(news.id));
  }
  async createNews(item: InsertNews): Promise<News> {
    const [created] = await db.insert(news).values(item).returning();
    return created;
  }
  async deleteNews(id: number): Promise<void> {
    await db.delete(news).where(eq(news.id, id));
  }

  // Columns
  async getColumns(): Promise<Column[]> {
    return await db.select().from(columns).orderBy(desc(columns.id));
  }
  async createColumn(item: InsertColumn): Promise<Column> {
    const [created] = await db.insert(columns).values(item).returning();
    return created;
  }
  async deleteColumn(id: number): Promise<void> {
    await db.delete(columns).where(eq(columns.id, id));
  }

  // Sermons
  async getSermons(): Promise<Sermon[]> {
    return await db.select().from(sermons).orderBy(desc(sermons.id));
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
