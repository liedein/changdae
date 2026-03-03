import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { api, buildUrl } from "@shared/routes";
import { useToast } from "./use-toast";
import type { InsertBulletin, InsertNews, InsertColumn, InsertSermon } from "@shared/schema";

// --- BULLETINS ---
export function useBulletins() {
  return useQuery({
    queryKey: [api.bulletins.list.path],
    queryFn: async () => {
      const res = await fetch(api.bulletins.list.path, { credentials: "include" });
      if (!res.ok) throw new Error("Failed to fetch");
      return api.bulletins.list.responses[200].parse(await res.json());
    }
  });
}

export function useCreateBulletin() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (data: InsertBulletin) => {
      const res = await fetch(api.bulletins.create.path, {
        method: api.bulletins.create.method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include",
      });
      if (!res.ok) throw new Error("Failed to create");
      return await res.json();
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.bulletins.list.path] });
      toast({ title: "성공", description: "주보가 등록되었습니다." });
    }
  });
}

export function useDeleteBulletin() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (id: number) => {
      const url = buildUrl(api.bulletins.delete.path, { id });
      const res = await fetch(url, { method: api.bulletins.delete.method, credentials: "include" });
      if (!res.ok) throw new Error("Failed to delete");
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.bulletins.list.path] });
      toast({ title: "성공", description: "삭제되었습니다." });
    }
  });
}

// --- NEWS ---
export function useNews() {
  return useQuery({
    queryKey: [api.news.list.path],
    queryFn: async () => {
      const res = await fetch(api.news.list.path, { credentials: "include" });
      if (!res.ok) throw new Error("Failed to fetch");
      return api.news.list.responses[200].parse(await res.json());
    }
  });
}

export function useCreateNews() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (data: InsertNews) => {
      const res = await fetch(api.news.create.path, {
        method: api.news.create.method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include",
      });
      if (!res.ok) throw new Error("Failed to create");
      return await res.json();
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.news.list.path] });
      toast({ title: "성공", description: "소식이 등록되었습니다." });
    }
  });
}

export function useDeleteNews() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (id: number) => {
      const url = buildUrl(api.news.delete.path, { id });
      const res = await fetch(url, { method: api.news.delete.method, credentials: "include" });
      if (!res.ok) throw new Error("Failed to delete");
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.news.list.path] });
      toast({ title: "성공", description: "삭제되었습니다." });
    }
  });
}

// --- COLUMNS ---
export function useColumns() {
  return useQuery({
    queryKey: [api.columns.list.path],
    queryFn: async () => {
      const res = await fetch(api.columns.list.path, { credentials: "include" });
      if (!res.ok) throw new Error("Failed to fetch");
      return api.columns.list.responses[200].parse(await res.json());
    }
  });
}

export function useCreateColumn() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (data: InsertColumn) => {
      const res = await fetch(api.columns.create.path, {
        method: api.columns.create.method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include",
      });
      if (!res.ok) throw new Error("Failed to create");
      return await res.json();
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.columns.list.path] });
      toast({ title: "성공", description: "칼럼이 등록되었습니다." });
    }
  });
}

export function useDeleteColumn() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (id: number) => {
      const url = buildUrl(api.columns.delete.path, { id });
      const res = await fetch(url, { method: api.columns.delete.method, credentials: "include" });
      if (!res.ok) throw new Error("Failed to delete");
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.columns.list.path] });
      toast({ title: "성공", description: "삭제되었습니다." });
    }
  });
}

// --- SERMONS ---
export function useSermons() {
  return useQuery({
    queryKey: [api.sermons.list.path],
    queryFn: async () => {
      const res = await fetch(api.sermons.list.path, { credentials: "include" });
      if (!res.ok) throw new Error("Failed to fetch");
      return api.sermons.list.responses[200].parse(await res.json());
    }
  });
}

export function useCreateSermon() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (data: InsertSermon) => {
      const res = await fetch(api.sermons.create.path, {
        method: api.sermons.create.method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include",
      });
      if (!res.ok) throw new Error("Failed to create");
      return await res.json();
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.sermons.list.path] });
      toast({ title: "성공", description: "설교가 등록되었습니다." });
    }
  });
}

export function useDeleteSermon() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  return useMutation({
    mutationFn: async (id: number) => {
      const url = buildUrl(api.sermons.delete.path, { id });
      const res = await fetch(url, { method: api.sermons.delete.method, credentials: "include" });
      if (!res.ok) throw new Error("Failed to delete");
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.sermons.list.path] });
      toast({ title: "성공", description: "삭제되었습니다." });
    }
  });
}
