import { useState } from "react";
import { useBulletins } from "@/hooks/use-boards";
import { format } from "date-fns";
import { ChevronLeft, ChevronRight, Loader2 } from "lucide-react";

export default function Bulletins() {
  const { data: bulletins, isLoading } = useBulletins();
  const [currentIndex, setCurrentIndex] = useState(0);

  if (isLoading) {
    return <div className="min-h-screen flex justify-center items-center"><Loader2 className="w-8 h-8 animate-spin text-primary" /></div>;
  }

  if (!bulletins || bulletins.length === 0) {
    return (
      <div className="pt-32 pb-24 min-h-[70vh] flex flex-col items-center justify-center">
        <h1 className="text-3xl font-bold text-foreground mb-4">주보</h1>
        <p className="text-muted-foreground">등록된 주보가 없습니다.</p>
      </div>
    );
  }

  const current = bulletins[currentIndex];
  const hasNext = currentIndex > 0; // newer
  const hasPrev = currentIndex < bulletins.length - 1; // older

  return (
    <div className="pt-32 pb-24 min-h-screen bg-background">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12 border-b border-border/50 pb-12">
          <p className="text-primary font-medium mb-3">
            {format(new Date(current.publishDate), 'yyyy년 MM월 dd일')}
          </p>
          <h1 className="text-4xl font-bold text-foreground ko-heading">{current.title}</h1>
        </div>

        {/* Vertical Images */}
        <div className="space-y-8 mb-8 flex flex-col items-center">
          {current.imageUrls.map((url: string, i: number) => (
            <img 
              key={i} 
              src={url.trim()} 
              alt={`Bulletin page ${i + 1}`} 
              className="max-w-full h-auto rounded-xl shadow-lg border border-border/50"
              loading="lazy"
            />
          ))}
        </div>

        {current.content && (
          <div className="prose dark:prose-invert max-w-none mb-16 p-8 bg-card border border-border/50 rounded-2xl shadow-sm" dangerouslySetInnerHTML={{ __html: current.content }} />
        )}

        {/* Navigation Buttons */}
        <div className="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-border/50 pt-8">
          <button
            onClick={() => hasPrev && setCurrentIndex(curr => curr + 1)}
            disabled={!hasPrev}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
          >
            <ChevronLeft className="w-5 h-5" />
            <div className="text-left">
              <div className="text-xs text-muted-foreground">이전 주보</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasPrev ? bulletins[currentIndex + 1].title : "이전 글이 없습니다"}
              </div>
            </div>
          </button>

          <button
            onClick={() => hasNext && setCurrentIndex(curr => curr - 1)}
            disabled={!hasNext}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
          >
            <div className="text-right">
              <div className="text-xs text-muted-foreground">다음 주보</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasNext ? bulletins[currentIndex - 1].title : "최신 글입니다"}
              </div>
            </div>
            <ChevronRight className="w-5 h-5" />
          </button>
        </div>
      </div>
    </div>
  );
}
