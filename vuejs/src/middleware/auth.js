// src/middleware/auth.js

export default function (to, from, next) {
    // Kiểm tra trạng thái đăng nhập của người dùng từ Vuex hoặc bất kỳ nơi nào khác
    const isAuthenticated = store.getters.isLoggedIn;
  
    if (!isAuthenticated) {
      // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
      next('/login');
    } else {
      // Nếu đã đăng nhập, cho phép truy cập trang
      next();
    }
  }
  