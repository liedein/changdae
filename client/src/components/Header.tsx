import { useState, useEffect } from "react";
import { Link, useLocation } from "wouter";
import { ThemeToggle } from "./ThemeToggle";
import { Menu, X, ChevronDown } from "lucide-react";
import { cn } from "@/lib/utils";
import { motion, AnimatePresence } from "framer-motion";

const MENU_ITEMS = [
  { name: "Home", path: "/" },
  {
    name: "소개합니다",
    path: "/about",
    subItems: [
      { name: "비전과 철학", path: "/about/vision" },
      { name: "사명", path: "/about/mission" },
      { name: "섬기는 사람들", path: "/staff" },
      { name: "목장", path: "/about/groups" },
      { name: "삶공부", path: "/about/study" },
      { name: "창대소식", path: "/news" },
      { name: "오시는 길", path: "/about/location" },
    ],
  },
  {
    name: "예배합니다",
    path: "/worship",
    subItems: [
      { name: "주일예배", path: "/sermons" },
      { name: "목장연합기도회", path: "/worship/prayer" },
      { name: "주보", path: "/bulletins" },
    ],
  },
  {
    name: "함께합니다",
    path: "/join",
    subItems: [
      { name: "파송 및 후원선교사", path: "/join/missions" },
      { name: "이웃섬김", path: "/join/service" },
      { name: "목회칼럼", path: "/columns" },
    ],
  },
];

export function Header() {
  const [isScrolled, setIsScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [location] = useLocation();
  const isHome = location === "/";

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 20);
    };
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  // Close mobile menu on navigation
  useEffect(() => {
    setMobileMenuOpen(false);
  }, [location]);

  const headerClasses = cn(
    "fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b",
    isScrolled 
      ? "bg-background/80 backdrop-blur-md border-border/50 py-3 shadow-sm" 
      : isHome 
        ? "bg-transparent border-transparent py-5" 
        : "bg-background border-border/50 py-5"
  );

  const textClasses = cn(
    "transition-colors duration-300 font-medium",
    (!isScrolled && isHome) ? "text-white hover:text-white/80" : "text-foreground hover:text-primary"
  );

  return (
    <>
      <header className={headerClasses}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between">
            {/* Logo */}
            <Link href="/" className={cn("text-2xl font-bold tracking-tighter", (!isScrolled && isHome) ? "text-white" : "text-foreground")}>
              CHANGDAE
            </Link>

            {/* Desktop Navigation */}
            <nav className="hidden md:flex items-center space-x-8">
              {MENU_ITEMS.map((item) => (
                <div key={item.name} className="relative group">
                  {item.subItems ? (
                    <div className="flex items-center gap-1 cursor-pointer py-2">
                      <span className={textClasses}>{item.name}</span>
                      <ChevronDown className={cn("w-4 h-4", textClasses)} />
                    </div>
                  ) : (
                    <Link href={item.path} className={cn("block py-2", textClasses)}>
                      {item.name}
                    </Link>
                  )}

                  {/* Dropdown */}
                  {item.subItems && (
                    <div className="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200">
                      <div className="bg-popover border border-border shadow-lg rounded-xl py-2 min-w-[180px] overflow-hidden">
                        {item.subItems.map((sub) => (
                          <Link 
                            key={sub.name} 
                            href={sub.path}
                            className="block px-4 py-2 text-sm text-popover-foreground hover:bg-muted hover:text-primary transition-colors"
                          >
                            {sub.name}
                          </Link>
                        ))}
                      </div>
                    </div>
                  )}
                </div>
              ))}
            </nav>

            {/* Actions */}
            <div className="flex items-center gap-4">
              <ThemeToggle />
              <button 
                className="md:hidden p-2 -mr-2 text-foreground"
                onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              >
                {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className={cn("w-6 h-6", (!isScrolled && isHome) ? "text-white" : "text-foreground")} />}
              </button>
            </div>
          </div>
        </div>
      </header>

      {/* Mobile Menu */}
      <AnimatePresence>
        {mobileMenuOpen && (
          <motion.div 
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            className="fixed inset-0 z-40 bg-background pt-20 overflow-y-auto"
          >
            <div className="p-4 space-y-6">
              {MENU_ITEMS.map((item) => (
                <div key={item.name} className="space-y-3">
                  <div className="font-bold text-lg text-foreground border-b border-border/50 pb-2">
                    {item.subItems ? item.name : <Link href={item.path}>{item.name}</Link>}
                  </div>
                  {item.subItems && (
                    <div className="flex flex-col space-y-3 pl-4">
                      {item.subItems.map((sub) => (
                        <Link 
                          key={sub.name} 
                          href={sub.path}
                          className="text-muted-foreground hover:text-primary transition-colors"
                        >
                          {sub.name}
                        </Link>
                      ))}
                    </div>
                  )}
                </div>
              ))}
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
