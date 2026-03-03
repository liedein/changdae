import { Header } from "./Header";
import { Footer } from "./Footer";
import { useLocation } from "wouter";

export function Layout({ children }: { children: React.ReactNode }) {
  const [location] = useLocation();
  const isAdmin = location.startsWith("/admin");

  if (isAdmin) {
    return <div className="min-h-screen bg-muted/20 font-body">{children}</div>;
  }

  return (
    <div className="min-h-screen flex flex-col font-body">
      <Header />
      <main className="flex-1">
        {children}
      </main>
      <Footer />
    </div>
  );
}
