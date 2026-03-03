import { useState } from "react";
import { useAdminLogin, useAdminMe, useAdminLogout } from "@/hooks/use-admin";
import { useBulletins, useCreateBulletin, useDeleteBulletin, useNews, useCreateNews, useDeleteNews, useColumns, useCreateColumn, useDeleteColumn, useSermons, useCreateSermon, useDeleteSermon } from "@/hooks/use-boards";
import { Loader2, LogOut, Trash2 } from "lucide-react";

export default function Admin() {
  const { data: me, isLoading: meLoading } = useAdminMe();
  const loginMutation = useAdminLogin();
  const logoutMutation = useAdminLogout();

  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [activeTab, setActiveTab] = useState("bulletins");

  if (meLoading) return <div className="min-h-screen flex items-center justify-center"><Loader2 className="w-8 h-8 animate-spin" /></div>;

  if (!me?.loggedIn) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-background p-4">
        <div className="w-full max-w-md bg-card p-8 rounded-2xl shadow-xl border border-border/50">
          <h1 className="text-2xl font-bold mb-6 text-center text-foreground ko-heading">관리자 로그인</h1>
          <form onSubmit={(e) => { e.preventDefault(); loginMutation.mutate({ username, password }); }} className="space-y-4">
            <div>
              <label className="block text-sm font-medium mb-1 text-foreground">아이디</label>
              <input 
                type="text" 
                value={username} onChange={e => setUsername(e.target.value)}
                className="w-full px-4 py-3 rounded-xl bg-background border-2 border-border focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
              />
            </div>
            <div>
              <label className="block text-sm font-medium mb-1 text-foreground">비밀번호</label>
              <input 
                type="password" 
                value={password} onChange={e => setPassword(e.target.value)}
                className="w-full px-4 py-3 rounded-xl bg-background border-2 border-border focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
              />
            </div>
            <button 
              type="submit" 
              disabled={loginMutation.isPending}
              className="w-full py-3 bg-primary text-primary-foreground rounded-xl font-semibold hover:bg-primary/90 transition-colors disabled:opacity-50"
            >
              {loginMutation.isPending ? "로그인 중..." : "로그인"}
            </button>
          </form>
        </div>
      </div>
    );
  }

  const tabs = [
    { id: "bulletins", name: "주보 관리" },
    { id: "news", name: "소식 관리" },
    { id: "sermons", name: "설교 관리" },
    { id: "columns", name: "칼럼 관리" },
  ];

  return (
    <div className="min-h-screen bg-muted/20 p-4 md:p-8">
      <div className="max-w-6xl mx-auto">
        <div className="flex justify-between items-center mb-8 bg-card p-4 rounded-2xl shadow-sm border border-border/50">
          <h1 className="text-2xl font-bold text-foreground ko-heading">관리자 대시보드</h1>
          <button 
            onClick={() => logoutMutation.mutate()}
            className="flex items-center gap-2 px-4 py-2 bg-secondary text-secondary-foreground rounded-lg hover:bg-secondary/80 transition-colors text-sm"
          >
            <LogOut className="w-4 h-4" /> 로그아웃
          </button>
        </div>

        <div className="flex gap-2 overflow-x-auto pb-4 mb-4">
          {tabs.map(tab => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id)}
              className={`px-6 py-3 rounded-xl font-medium whitespace-nowrap transition-all ${
                activeTab === tab.id 
                  ? "bg-primary text-primary-foreground shadow-md" 
                  : "bg-card text-muted-foreground hover:bg-secondary border border-border/50"
              }`}
            >
              {tab.name}
            </button>
          ))}
        </div>

        <div className="bg-card border border-border/50 rounded-2xl p-6 shadow-sm">
          {activeTab === "bulletins" && <AdminBulletins />}
          {activeTab === "news" && <AdminNews />}
          {activeTab === "sermons" && <AdminSermons />}
          {activeTab === "columns" && <AdminColumns />}
        </div>
      </div>
    </div>
  );
}

// Sub-components for Admin

function AdminBulletins() {
  const { data: items } = useBulletins();
  const createMut = useCreateBulletin();
  const deleteMut = useDeleteBulletin();
  const [title, setTitle] = useState("");
  const [images, setImages] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const imageUrls = images.split(",").map(s => s.trim()).filter(Boolean);
    createMut.mutate({ title, imageUrls }, { onSuccess: () => { setTitle(""); setImages(""); }});
  };

  return (
    <div className="grid md:grid-cols-2 gap-8">
      <div>
        <h3 className="text-lg font-bold mb-4">새 주보 등록</h3>
        <form onSubmit={handleSubmit} className="space-y-4">
          <input placeholder="제목 (예: 2024년 1월 1일 주보)" value={title} onChange={e=>setTitle(e.target.value)} required className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background" />
          <textarea placeholder="이미지 URL (콤마로 구분)" value={images} onChange={e=>setImages(e.target.value)} required rows={4} className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background resize-none" />
          <button type="submit" disabled={createMut.isPending} className="px-4 py-2 bg-primary text-primary-foreground rounded-lg disabled:opacity-50">등록</button>
        </form>
      </div>
      <div>
        <h3 className="text-lg font-bold mb-4">목록</h3>
        <div className="space-y-2 max-h-[500px] overflow-y-auto pr-2">
          {items?.map(item => (
            <div key={item.id} className="flex justify-between items-center p-3 bg-secondary/50 rounded-lg">
              <span className="font-medium truncate pr-4">{item.title}</span>
              <button onClick={() => { if(confirm('삭제하시겠습니까?')) deleteMut.mutate(item.id) }} className="p-2 text-destructive hover:bg-destructive/10 rounded-md"><Trash2 className="w-4 h-4"/></button>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

function AdminNews() {
  const { data: items } = useNews();
  const createMut = useCreateNews();
  const deleteMut = useDeleteNews();
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    createMut.mutate({ title, content }, { onSuccess: () => { setTitle(""); setContent(""); }});
  };

  return (
    <div className="grid md:grid-cols-2 gap-8">
      <div>
        <h3 className="text-lg font-bold mb-4">새 소식 등록</h3>
        <form onSubmit={handleSubmit} className="space-y-4">
          <input placeholder="제목" value={title} onChange={e=>setTitle(e.target.value)} required className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background" />
          <textarea placeholder="내용" value={content} onChange={e=>setContent(e.target.value)} required rows={8} className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background resize-none" />
          <button type="submit" disabled={createMut.isPending} className="px-4 py-2 bg-primary text-primary-foreground rounded-lg disabled:opacity-50">등록</button>
        </form>
      </div>
      <div>
        <h3 className="text-lg font-bold mb-4">목록</h3>
        <div className="space-y-2 max-h-[500px] overflow-y-auto pr-2">
          {items?.map(item => (
            <div key={item.id} className="flex justify-between items-center p-3 bg-secondary/50 rounded-lg">
              <span className="font-medium truncate pr-4">{item.title}</span>
              <button onClick={() => { if(confirm('삭제하시겠습니까?')) deleteMut.mutate(item.id) }} className="p-2 text-destructive hover:bg-destructive/10 rounded-md"><Trash2 className="w-4 h-4"/></button>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

function AdminSermons() {
  const { data: items } = useSermons();
  const createMut = useCreateSermon();
  const deleteMut = useDeleteSermon();
  const [title, setTitle] = useState("");
  const [passage, setPassage] = useState("");
  const [preacher, setPreacher] = useState("");
  const [videoUrl, setVideoUrl] = useState("");
  const [date, setDate] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // z.coerce.date handles strings, but we need standard format YYYY-MM-DD
    createMut.mutate({ title, passage, preacher, videoUrl, sermonDate: new Date(date) }, { onSuccess: () => { 
      setTitle(""); setPassage(""); setPreacher(""); setVideoUrl(""); setDate(""); 
    }});
  };

  return (
    <div className="grid md:grid-cols-2 gap-8">
      <div>
        <h3 className="text-lg font-bold mb-4">새 설교 등록</h3>
        <form onSubmit={handleSubmit} className="space-y-4">
          <input placeholder="제목" value={title} onChange={e=>setTitle(e.target.value)} required className="w-full px-4 py-2 rounded-lg border bg-background" />
          <div className="grid grid-cols-2 gap-4">
            <input placeholder="본문 (예: 요 3:16)" value={passage} onChange={e=>setPassage(e.target.value)} required className="w-full px-4 py-2 rounded-lg border bg-background" />
            <input placeholder="설교자 (예: 김목사)" value={preacher} onChange={e=>setPreacher(e.target.value)} required className="w-full px-4 py-2 rounded-lg border bg-background" />
          </div>
          <input placeholder="유튜브 링크" type="url" value={videoUrl} onChange={e=>setVideoUrl(e.target.value)} required className="w-full px-4 py-2 rounded-lg border bg-background" />
          <input type="date" value={date} onChange={e=>setDate(e.target.value)} required className="w-full px-4 py-2 rounded-lg border bg-background" />
          <button type="submit" disabled={createMut.isPending} className="px-4 py-2 bg-primary text-primary-foreground rounded-lg disabled:opacity-50">등록</button>
        </form>
      </div>
      <div>
        <h3 className="text-lg font-bold mb-4">목록</h3>
        <div className="space-y-2 max-h-[500px] overflow-y-auto pr-2">
          {items?.map(item => (
            <div key={item.id} className="flex justify-between items-center p-3 bg-secondary/50 rounded-lg">
              <span className="font-medium truncate pr-4">{item.title}</span>
              <button onClick={() => { if(confirm('삭제하시겠습니까?')) deleteMut.mutate(item.id) }} className="p-2 text-destructive hover:bg-destructive/10 rounded-md"><Trash2 className="w-4 h-4"/></button>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

function AdminColumns() {
  const { data: items } = useColumns();
  const createMut = useCreateColumn();
  const deleteMut = useDeleteColumn();
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    createMut.mutate({ title, content }, { onSuccess: () => { setTitle(""); setContent(""); }});
  };

  return (
    <div className="grid md:grid-cols-2 gap-8">
      <div>
        <h3 className="text-lg font-bold mb-4">새 칼럼 등록</h3>
        <form onSubmit={handleSubmit} className="space-y-4">
          <input placeholder="제목" value={title} onChange={e=>setTitle(e.target.value)} required className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background" />
          <textarea placeholder="내용" value={content} onChange={e=>setContent(e.target.value)} required rows={8} className="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-primary/20 outline-none bg-background resize-none" />
          <button type="submit" disabled={createMut.isPending} className="px-4 py-2 bg-primary text-primary-foreground rounded-lg disabled:opacity-50">등록</button>
        </form>
      </div>
      <div>
        <h3 className="text-lg font-bold mb-4">목록</h3>
        <div className="space-y-2 max-h-[500px] overflow-y-auto pr-2">
          {items?.map(item => (
            <div key={item.id} className="flex justify-between items-center p-3 bg-secondary/50 rounded-lg">
              <span className="font-medium truncate pr-4">{item.title}</span>
              <button onClick={() => { if(confirm('삭제하시겠습니까?')) deleteMut.mutate(item.id) }} className="p-2 text-destructive hover:bg-destructive/10 rounded-md"><Trash2 className="w-4 h-4"/></button>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}
