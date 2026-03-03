import { Link } from "wouter";

export function Footer() {
  return (
    <footer className="bg-secondary/50 border-t py-12 mt-auto">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div className="col-span-1 md:col-span-2">
            <h2 className="text-2xl font-bold tracking-tighter mb-4 text-foreground">CHANGDAE</h2>
            <p className="text-muted-foreground max-w-sm mb-6 leading-relaxed">
              우리는 예수 그리스도의 복음을 전하며, 이웃을 섬기고, 세상을 변화시키는 생명 공동체입니다.
            </p>
            <div className="text-sm text-muted-foreground space-y-1">
              <p>주소: 서울특별시 창대구 창대로 123 창대교회</p>
              <p>전화: 02-123-4567 | 팩스: 02-123-4568</p>
            </div>
          </div>
          
          <div>
            <h3 className="font-semibold text-foreground mb-4">빠른 링크</h3>
            <ul className="space-y-3 text-sm">
              <li><Link href="/staff" className="text-muted-foreground hover:text-primary transition-colors">섬기는 사람들</Link></li>
              <li><Link href="/sermons" className="text-muted-foreground hover:text-primary transition-colors">주일예배</Link></li>
              <li><Link href="/news" className="text-muted-foreground hover:text-primary transition-colors">창대소식</Link></li>
              <li><Link href="/bulletins" className="text-muted-foreground hover:text-primary transition-colors">주보</Link></li>
            </ul>
          </div>
          
          <div>
            <h3 className="font-semibold text-foreground mb-4">관리</h3>
            <ul className="space-y-3 text-sm">
              <li><Link href="/admin" className="text-muted-foreground hover:text-primary transition-colors">관리자 로그인</Link></li>
            </ul>
          </div>
        </div>
        
        <div className="border-t border-border/50 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-muted-foreground">
          <p>© {new Date().getFullYear()} Changdae Church. All rights reserved.</p>
          <div className="flex space-x-4 mt-4 md:mt-0">
            <a href="#" className="hover:text-primary transition-colors">Privacy Policy</a>
            <a href="#" className="hover:text-primary transition-colors">Terms of Service</a>
          </div>
        </div>
      </div>
    </footer>
  );
}
