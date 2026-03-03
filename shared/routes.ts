import { z } from "zod";
import { insertBulletinSchema, insertNewsSchema, insertColumnSchema, insertSermonSchema, adminLoginSchema } from "./schema";

export const errorSchemas = {
  validation: z.object({ message: z.string(), field: z.string().optional() }),
  notFound: z.object({ message: z.string() }),
  unauthorized: z.object({ message: z.string() }),
};

export const api = {
  admin: {
    login: {
      method: "POST" as const,
      path: "/api/admin/login" as const,
      input: adminLoginSchema,
      responses: {
        200: z.object({ message: z.string() }),
        401: errorSchemas.unauthorized,
      },
    },
    logout: {
      method: "POST" as const,
      path: "/api/admin/logout" as const,
      responses: {
        200: z.object({ message: z.string() }),
      }
    },
    me: {
      method: "GET" as const,
      path: "/api/admin/me" as const,
      responses: {
        200: z.object({ loggedIn: z.boolean() }),
        401: errorSchemas.unauthorized,
      }
    }
  },
  bulletins: {
    list: { method: "GET" as const, path: "/api/bulletins" as const, responses: { 200: z.array(z.custom<any>()) } },
    create: { method: "POST" as const, path: "/api/bulletins" as const, input: insertBulletinSchema, responses: { 201: z.custom<any>(), 401: errorSchemas.unauthorized } },
    delete: { method: "DELETE" as const, path: "/api/bulletins/:id" as const, responses: { 204: z.void(), 404: errorSchemas.notFound, 401: errorSchemas.unauthorized } },
  },
  news: {
    list: { method: "GET" as const, path: "/api/news" as const, responses: { 200: z.array(z.custom<any>()) } },
    create: { method: "POST" as const, path: "/api/news" as const, input: insertNewsSchema, responses: { 201: z.custom<any>(), 401: errorSchemas.unauthorized } },
    delete: { method: "DELETE" as const, path: "/api/news/:id" as const, responses: { 204: z.void(), 404: errorSchemas.notFound, 401: errorSchemas.unauthorized } },
  },
  columns: {
    list: { method: "GET" as const, path: "/api/columns" as const, responses: { 200: z.array(z.custom<any>()) } },
    create: { method: "POST" as const, path: "/api/columns" as const, input: insertColumnSchema, responses: { 201: z.custom<any>(), 401: errorSchemas.unauthorized } },
    delete: { method: "DELETE" as const, path: "/api/columns/:id" as const, responses: { 204: z.void(), 404: errorSchemas.notFound, 401: errorSchemas.unauthorized } },
  },
  sermons: {
    list: { method: "GET" as const, path: "/api/sermons" as const, responses: { 200: z.array(z.custom<any>()) } },
    create: { method: "POST" as const, path: "/api/sermons" as const, input: insertSermonSchema, responses: { 201: z.custom<any>(), 401: errorSchemas.unauthorized } },
    delete: { method: "DELETE" as const, path: "/api/sermons/:id" as const, responses: { 204: z.void(), 404: errorSchemas.notFound, 401: errorSchemas.unauthorized } },
  },
};

export function buildUrl(path: string, params?: Record<string, string | number>): string {
  let url = path;
  if (params) {
    Object.entries(params).forEach(([key, value]) => {
      if (url.includes(`:${key}`)) {
        url = url.replace(`:${key}`, String(value));
      }
    });
  }
  return url;
}
