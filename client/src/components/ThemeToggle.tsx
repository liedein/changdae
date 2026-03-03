import { Moon, Sun } from "lucide-react";
import { useTheme } from "@/lib/theme";

export function ThemeToggle() {
  const { theme, setTheme } = useTheme();

  return (
    <button
      onClick={() => setTheme(theme === "light" ? "dark" : "light")}
      className="relative inline-flex h-9 w-9 items-center justify-center rounded-full bg-secondary text-secondary-foreground hover:bg-secondary/80 transition-colors duration-200"
      aria-label="Toggle theme"
    >
      <Sun className="h-4 w-4 scale-100 transition-all dark:scale-0" />
      <Moon className="absolute h-4 w-4 scale-0 transition-all dark:scale-100" />
    </button>
  );
}
