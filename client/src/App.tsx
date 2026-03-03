import { Switch, Route } from "wouter";
import { queryClient } from "./lib/queryClient";
import { QueryClientProvider } from "@tanstack/react-query";
import { Toaster } from "@/components/ui/toaster";
import { TooltipProvider } from "@/components/ui/tooltip";
import { ThemeProvider } from "@/lib/theme";

// Components
import { Layout } from "@/components/Layout";

// Pages
import Home from "@/pages/Home";
import Staff from "@/pages/Staff";
import Bulletins from "@/pages/Bulletins";
import News from "@/pages/News";
import Sermons from "@/pages/Sermons";
import Columns from "@/pages/Columns";
import Admin from "@/pages/Admin";
import Placeholder from "@/pages/Placeholder";
import NotFound from "@/pages/not-found";

function Router() {
  return (
    <Layout>
      <Switch>
        <Route path="/" component={Home} />
        
        {/* About */}
        <Route path="/staff" component={Staff} />
        <Route path="/about/vision" component={Placeholder} />
        <Route path="/about/mission" component={Placeholder} />
        <Route path="/about/groups" component={Placeholder} />
        <Route path="/about/study" component={Placeholder} />
        <Route path="/about/location" component={Placeholder} />
        
        {/* Boards */}
        <Route path="/news" component={News} />
        <Route path="/bulletins" component={Bulletins} />
        <Route path="/sermons" component={Sermons} />
        <Route path="/columns" component={Columns} />
        
        {/* Worship/Join Placeholders */}
        <Route path="/worship/prayer" component={Placeholder} />
        <Route path="/join/missions" component={Placeholder} />
        <Route path="/join/service" component={Placeholder} />
        
        {/* Admin */}
        <Route path="/admin" component={Admin} />
        
        {/* Fallback to 404 */}
        <Route component={NotFound} />
      </Switch>
    </Layout>
  );
}

function App() {
  return (
    <QueryClientProvider client={queryClient}>
      <ThemeProvider defaultTheme="system" storageKey="changdae-theme">
        <TooltipProvider>
          <Toaster />
          <Router />
        </TooltipProvider>
      </ThemeProvider>
    </QueryClientProvider>
  );
}

export default App;
