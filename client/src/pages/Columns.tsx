import { useState } from "react";
import { useColumns } from "@/hooks/use-boards";
import { format } from "date-fns";
import { ChevronLeft, ChevronRight, Loader2 } from "lucide-react";

export default function Columns() {
  const { data: items, isLoading } = useColumns();
  const [currentIndex, setCurrentIndex] = useState(0);

  if (isLoading) {
    return <div className="min-h-screen flex justify-center items-center"><Loader2 className="w-8 h-8 animate-spin text-primary" /></div>;
  }

  if (!items || items.length === 0) {
    return (
      <div className="pt-32 pb-24 min-h-[70vh] flex flex-col items-center justify-center">
        <h1 className="text-3xl font-bold text-foreground mb-4">목회칼럼</h1>
        <p className="text-muted-foreground">등록된 칼럼이 없습니다.</p>
      </div>
    );
  }

  const current = items[currentIndex];
  const hasNext = currentIndex > 0;
  const hasPrev = currentIndex < items.length - 1;

  return (
    <div className="pt-32 pb-24 min-h-screen bg-background">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="mb-12 border-b border-border/50 pb-8 text-center">
          <p className="text-primary font-medium mb-3">목회칼럼</p>
          <h1 className="text-3xl md:text-4xl font-bold text-foreground mb-4 ko-heading">{current.title}</h1>
          <p className="text-muted-foreground">
            {format(new Date(current.createdAt), 'yyyy.MM.dd')}
          </p>
        </div>

        <div className="prose dark:prose-invert max-w-none mb-20 text-lg leading-loose min-h-[30vh]">
          {current.content.split('\n').map((line: string, i: number) => (
            <p key={i}>{line}</p>
          ))}
        </div>

        <div className="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-border/50 pt-8">
          <button
            onClick={() => hasPrev && setCurrentIndex(curr => curr + 1)}
            disabled={!hasPrev}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 transition-colors"
          >
            <ChevronLeft className="w-5 h-5" />
            <div className="text-left">
              <div className="text-xs text-muted-foreground">이전 칼럼</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasPrev ? items[currentIndex + 1].title : "이전 글이 없습니다"}
              </div>
            </div>
          </button>

          <button
            onClick={() => hasNext && setCurrentIndex(curr => curr - 1)}
            disabled={!hasNext}
            className="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-secondary/50 text-foreground hover:bg-secondary disabled:opacity-50 transition-colors"
          >
            <div className="text-right">
              <div className="text-xs text-muted-foreground">다음 칼럼</div>
              <div className="font-semibold truncate max-w-[200px]">
                {hasNext ? items[currentIndex - 1].title : "최신 글입니다"}
              </div>
            </div>
            <ChevronRight className="w-5 h-5" />
          </button>
        </div>
      </div>
    </div>
  );
}
