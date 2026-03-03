import { pgTable, text, serial, timestamp, date } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod";

export const bulletins = pgTable("bulletins", {
  id: serial("id").primaryKey(),
  title: text("title").notNull(),
  content: text("content"),
  imageUrls: text("image_urls").array().notNull(),
  publishDate: date("publish_date").notNull(),
  createdAt: timestamp("created_at").defaultNow(),
});

export const news = pgTable("news", {
  id: serial("id").primaryKey(),
  title: text("title").notNull(),
  content: text("content").notNull(),
  publishDate: date("publish_date").notNull(),
  createdAt: timestamp("created_at").defaultNow(),
});

export const columns = pgTable("columns", {
  id: serial("id").primaryKey(),
  title: text("title").notNull(),
  content: text("content").notNull(),
  publishDate: date("publish_date").notNull(),
  createdAt: timestamp("created_at").defaultNow(),
});

export const sermons = pgTable("sermons", {
  id: serial("id").primaryKey(),
  title: text("title").notNull(),
  passage: text("passage").notNull(),
  preacher: text("preacher").notNull(),
  videoUrl: text("video_url").notNull(),
  publishDate: date("publish_date").notNull(),
  createdAt: timestamp("created_at").defaultNow(),
});

export const insertBulletinSchema = createInsertSchema(bulletins).omit({ id: true, createdAt: true });
export const insertNewsSchema = createInsertSchema(news).omit({ id: true, createdAt: true });
export const insertColumnSchema = createInsertSchema(columns).omit({ id: true, createdAt: true });
export const insertSermonSchema = createInsertSchema(sermons).omit({ id: true, createdAt: true });

export const adminLoginSchema = z.object({
  username: z.string(),
  password: z.string(),
});

export type Bulletin = typeof bulletins.$inferSelect;
export type InsertBulletin = z.infer<typeof insertBulletinSchema>;

export type News = typeof news.$inferSelect;
export type InsertNews = z.infer<typeof insertNewsSchema>;

export type Column = typeof columns.$inferSelect;
export type InsertColumn = z.infer<typeof insertColumnSchema>;

export type Sermon = typeof sermons.$inferSelect;
export type InsertSermon = z.infer<typeof insertSermonSchema>;
