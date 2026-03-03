import { motion } from "framer-motion";
import { Link } from "wouter";
import { ArrowRight, Calendar, Users, BookOpen } from "lucide-react";

export default function Home() {
  return (
    <div className="relative">
      {/* Hero Section (Merrypage style) */}
      <section className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        {/* Background Image with Dark Wash */}
        <div className="absolute inset-0 z-0">
          {/* landing page hero calm peaceful church interior architecture */}
          <img 
            src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&h=1080&fit=crop" 
            alt="Church Hero" 
            className="w-full h-full object-cover"
          />
          <div className="absolute inset-0 bg-black/40 mix-blend-multiply" />
          <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-background" />
        </div>

        <div className="relative z-10 text-center px-4 max-w-4xl mx-auto mt-20">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, ease: "easeOut" }}
          >
            <h1 className="text-5xl md:text-7xl lg:text-8xl font-bold text-white tracking-tight mb-6 ko-heading">
              환영합니다
            </h1>
            <p className="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl mx-auto font-light tracking-wide text-balance">
              하나님의 사랑이 머무는 곳, 창대교회에 오신 것을 진심으로 환영합니다.
            </p>
            <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
              <Link 
                href="/about/location" 
                className="px-8 py-4 bg-white text-black rounded-full font-semibold hover:bg-white/90 transition-all hover:scale-105 active:scale-95"
              >
                오시는 길
              </Link>
              <Link 
                href="/sermons" 
                className="px-8 py-4 bg-white/10 backdrop-blur-md text-white border border-white/20 rounded-full font-semibold hover:bg-white/20 transition-all hover:scale-105 active:scale-95 flex items-center gap-2"
              >
                최신 설교 듣기 <ArrowRight className="w-4 h-4" />
              </Link>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Quick Links Section */}
      <section className="py-24 bg-background">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <Link href="/sermons">
              <motion.div 
                whileHover={{ y: -5 }}
                className="group p-8 rounded-3xl bg-secondary/50 border border-border/50 hover:bg-secondary transition-colors cursor-pointer h-full"
              >
                <div className="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <BookOpen className="w-6 h-6" />
                </div>
                <h3 className="text-2xl font-bold mb-3 text-foreground ko-heading">주일예배</h3>
                <p className="text-muted-foreground leading-relaxed">
                  매주 주일 선포되는 생명의 말씀으로 은혜를 나눕니다. 온라인으로도 함께하실 수 있습니다.
                </p>
              </motion.div>
            </Link>

            <Link href="/bulletins">
              <motion.div 
                whileHover={{ y: -5 }}
                className="group p-8 rounded-3xl bg-secondary/50 border border-border/50 hover:bg-secondary transition-colors cursor-pointer h-full"
              >
                <div className="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <Calendar className="w-6 h-6" />
                </div>
                <h3 className="text-2xl font-bold mb-3 text-foreground ko-heading">주보 및 소식</h3>
                <p className="text-muted-foreground leading-relaxed">
                  교회의 다양한 소식과 한 주간의 일정을 확인하세요. 교제와 기도의 제목을 나눕니다.
                </p>
              </motion.div>
            </Link>

            <Link href="/staff">
              <motion.div 
                whileHover={{ y: -5 }}
                className="group p-8 rounded-3xl bg-secondary/50 border border-border/50 hover:bg-secondary transition-colors cursor-pointer h-full"
              >
                <div className="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                  <Users className="w-6 h-6" />
                </div>
                <h3 className="text-2xl font-bold mb-3 text-foreground ko-heading">섬기는 사람들</h3>
                <p className="text-muted-foreground leading-relaxed">
                  각자의 자리에서 헌신하며 교회를 섬기는 사역자들을 소개합니다.
                </p>
              </motion.div>
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}
