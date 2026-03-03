import { useState } from "react";
import { useSermons } from "@/hooks/use-boards";
import { format } from "date-fns";
import { ChevronLeft, ChevronRight, Loader2, BookOpen, User } from "lucide-react";
import { getYouTubeEmbedUrl } from "@/lib/youtube";

export default function Sermons() {
  const { data: sermons, isLoading } = useSermons();
  const [currentIndex, setCurrentIndex] = useState(0);

  if (isLoading) {
    return <div className="min-h-screen flex justify-center items-center"><Loader2 className="w-8 h-8 animate-spin text-primary" /></div>;
  }

  if (!sermons || sermons.length === 0) {
    return (
      <div className="pt-32 pb-24 min-h-[70vh] flex flex-col items-center justify-center">
        <h1 className="text-3xl font-bold text-foreground mb-4">주일예배</h1>
        <p className="text-muted-foreground">등록된 설교가 없습니다.</p>
      </div>
    );
  }

  const current = sermons[currentIndex];
  const hasNext = currentIndex > 0;
  const hasPrev = currentIndex < sermons.length - 1;
  const embedUrl = getYouTubeEmbedUrl(current.videoUrl);

  return (
    <div className="pt-32 pb-24 min-h-screen bg-background">
      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Video Player */}
        <div className="aspect-video bg-black rounded-2xl overflow-hidden mb-8 shadow-xl">
          {embedUrl ? (
            <iframe
              src={embedUrl}
              title="YouTube video player"
              className="w-full h-full border-0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
            />
          ) : (
            <div className="w-full h-full flex items-center justify-center text-white/50">
              유효하지 않은 영상 링크입니다.
            </div>
          )}
        </div>

        {/* Sermon Info */}
        <div className="bg-card border border-border/50 rounded-2xl p-8 mb-12 shadow-sm">
          <p className="text-primary font-medium mb-2">
            {format(new Date(current.publishDate), 'yyyy년 MM월 dd일')} 주일예배
          </p>
          <h1 className="text-3xl font-bold text-foreground mb-6 ko-heading">{current.title}</h1>
          
          <div className="flex flex-col sm:flex-row gap-6 text-muted-foreground bg-muted/30 p-4 rounded-xl">
            <div className="flex items-center gap-2">
              <BookOpen className="w-5 h-5 text-primary" />
              <span>본문: <strong className="text-foreground font-medium">{current.passage}</strong></span>
            </div>
            <div className="flex items-center gap-2">
              <User className="w-5 h-5 text-primary" />
              <span>설교자: <strong className="text-foreground font-medium">{current.preacher}</strong></span>
            </div>
          </div>
        </div>

        {/* Navigation */}
        <div className="flex flex-col sm:flex-row justify-between items-center gap-4">
          <button
            onClick={() => hasPrev && setCurrentIndex(curr => curr + 1)}
            disabled={!hasPrev}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 transition-colors"
          >
            <ChevronLeft className="w-5 h-5" />
            <div className="text-left">
              <div className="text-xs text-muted-foreground">이전 설교</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasPrev ? sermons[currentIndex + 1].title : "이전 글이 없습니다"}
              </div>
            </div>
          </button>

          <button
            onClick={() => hasNext && setCurrentIndex(curr => curr - 1)}
            disabled={!hasNext}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 transition-colors"
          >
            <div className="text-right">
              <div className="text-xs text-muted-foreground">다음 설교</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasNext ? sermons[currentIndex - 1].title : "최신 글입니다"}
              </div>
            </div>
            <ChevronRight className="w-5 h-5" />
          </button>
        </div>
      </div>
    </div>
  );
}
