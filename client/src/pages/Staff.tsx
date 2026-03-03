import { motion } from "framer-motion";

const staffMembers = [
  {
    name: "김목사",
    role: "담임목사",
    // placeholder portrait man
    imageUrl: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=800&h=800&fit=crop",
  },
  {
    name: "이목사",
    role: "부목사 / 청년부",
    // placeholder portrait man
    imageUrl: "https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=800&h=800&fit=crop",
  },
  {
    name: "박전도사",
    role: "교육전도사 / 주일학교",
    // placeholder portrait woman
    imageUrl: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=800&h=800&fit=crop",
  },
  {
    name: "최장로",
    role: "시무장로",
    // placeholder portrait older man
    imageUrl: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=800&fit=crop",
  }
];

export default function Staff() {
  return (
    <div className="pt-32 pb-24 min-h-screen bg-background">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <motion.div 
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="text-center max-w-3xl mx-auto mb-20"
        >
          <h1 className="text-4xl md:text-5xl font-bold text-foreground mb-6 ko-heading">섬기는 사람들</h1>
          <p className="text-lg text-muted-foreground">
            하나님의 부르심을 따라 각자의 자리에서 기쁨으로 교회를 섬기는 동역자들입니다.
          </p>
        </motion.div>

        {/* RedeemerBK Style Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
          {staffMembers.map((staff, index) => (
            <motion.div
              key={staff.name}
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: index * 0.1 }}
              className="group cursor-pointer"
            >
              <div className="relative overflow-hidden aspect-[4/5] rounded-2xl mb-6 bg-secondary">
                <img 
                  src={staff.imageUrl} 
                  alt={staff.name} 
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter grayscale group-hover:grayscale-0"
                />
                <div className="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
              </div>
              <div className="text-center">
                <h3 className="text-xl font-bold text-foreground mb-1">{staff.name}</h3>
                <p className="text-sm text-primary font-medium tracking-wide">{staff.role}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </div>
  );
}
