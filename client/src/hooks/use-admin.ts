import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { api } from "@shared/routes";
import { z } from "zod";
import { useToast } from "./use-toast";

export function useAdminMe() {
  return useQuery({
    queryKey: [api.admin.me.path],
    queryFn: async () => {
      const res = await fetch(api.admin.me.path, { credentials: "include" });
      if (res.status === 401) return { loggedIn: false };
      if (!res.ok) throw new Error("Failed to fetch admin status");
      return api.admin.me.responses[200].parse(await res.json());
    },
    retry: false,
  });
}

export function useAdminLogin() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  
  return useMutation({
    mutationFn: async (data: z.infer<typeof api.admin.login.input>) => {
      const res = await fetch(api.admin.login.path, {
        method: api.admin.login.method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
        credentials: "include",
      });
      if (!res.ok) {
        throw new Error("Invalid credentials");
      }
      return api.admin.login.responses[200].parse(await res.json());
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.admin.me.path] });
      toast({ title: "로그인 성공", description: "관리자 페이지에 접속했습니다." });
    },
    onError: () => {
      toast({ variant: "destructive", title: "로그인 실패", description: "아이디나 비밀번호를 확인해주세요." });
    }
  });
}

export function useAdminLogout() {
  const queryClient = useQueryClient();
  const { toast } = useToast();
  
  return useMutation({
    mutationFn: async () => {
      const res = await fetch(api.admin.logout.path, {
        method: api.admin.logout.method,
        credentials: "include",
      });
      if (!res.ok) throw new Error("Failed to logout");
      return api.admin.logout.responses[200].parse(await res.json());
    },
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: [api.admin.me.path] });
      toast({ title: "로그아웃", description: "성공적으로 로그아웃 되었습니다." });
    }
  });
}
