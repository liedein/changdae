import { Wrench } from "lucide-react";
import { motion } from "framer-motion";

export default function Placeholder() {
  return (
    <div className="min-h-[70vh] flex flex-col items-center justify-center px-4 pt-20">
      <motion.div
        initial={{ opacity: 0, scale: 0.9 }}
        animate={{ opacity: 1, scale: 1 }}
        className="text-center"
      >
        <div className="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-8">
          <Wrench className="w-10 h-10 text-muted-foreground" />
        </div>
        <h1 className="text-3xl font-bold text-foreground mb-4 ko-heading">현재 준비 중인 페이지입니다.</h1>
        <p className="text-muted-foreground max-w-md mx-auto">
          더 나은 콘텐츠를 제공하기 위해 페이지를 준비하고 있습니다. 
          빠른 시일 내에 찾아뵙겠습니다.
        </p>
      </motion.div>
    </div>
  );
}
