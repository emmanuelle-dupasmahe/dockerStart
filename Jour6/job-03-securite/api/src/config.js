const express = require('express');
const os = require('os');
const fs = require('fs');
const app = express();
const PORT = process.env.PORT || 3000;
app.get('/', (req, res) => {
const u = os.userInfo();
res.json({
user: u.username, uid: u.uid, gid: u.gid,
hostname: os.hostname(),
isRoot: u.uid === 0
});
});
app.get('/test-write', (req, res) => {
try {
fs.writeFileSync('/app/test.txt', 'test');
res.json({ result: 'write_succeeded', warning: 'filesystem not read-only!' });
} catch (e) { res.json({ result: 'write_blocked', error: e.code }); }
});
app.get('/test-tmp', (req, res) => {
try {
fs.writeFileSync('/tmp/test.txt', 'test');
res.json({ result: 'write_succeeded' });

} catch (e) { res.json({ result: 'write_blocked', error: e.code }); }
});
app.get('/health', (req, res) => res.json({ status: 'ok' }));
app.listen(PORT, '0.0.0.0', () => console.log(`Started uid=${os.userInfo().uid}`));
