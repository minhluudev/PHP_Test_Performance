# PHP test performance

## PHP-FPM

```
k6 run Stress_Test_PHP_FPM.js
```
### chọn số lượng worker PHP-FPM
#### Cách tính gần đúng

Ví dụ trung bình 1 worker ~ 40MB RAM:
```
1 GB RAM ≈ 1024 MB
1024 / 40 ≈ 25 worker
```

→ Lý thuyết bạn có thể set pm.max_children = 20–25.

Nhưng vì bạn chỉ có 1 CPU core, nếu bạn set nhiều quá (ví dụ 50 worker):

CPU không xử lý kịp → request xếp hàng, latency cao.

Context switch nhiều → hiệu năng giảm.