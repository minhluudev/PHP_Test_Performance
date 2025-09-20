import { sleep } from 'k6';
import http from 'k6/http';

export let options = {
  vus: 100,        // số lượng người dùng ảo đồng thời
  duration: '3s' // thời gian test
};

export default function () {
  http.get('http://localhost:8002/db-benchmark');
  sleep(1);
}
// k6 run Stress_Test_FRANKEN_PHP_WORKER.js