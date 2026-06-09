pour le premier bug : RUN chown -R appuser:appgroup /app
 docker build -t job03-api ./api
[+] Building 4.1s (12/12) FINISHED                                      docker:desktop-linux
 => [internal] load build definition from Dockerfile                                    0.0s
 => => transferring dockerfile: 678B                                                    0.0s
 => [internal] load metadata for docker.io/library/node:20-alpine                       0.0s
 => [internal] load .dockerignore                                                       0.0s
 => => transferring context: 2B                                                         0.0s
 => [1/7] FROM docker.io/library/node:20-alpine@sha256:fb4cd12c85ee03686f6af5362a0b0d5  0.0s
 => => resolve docker.io/library/node:20-alpine@sha256:fb4cd12c85ee03686f6af5362a0b0d5  0.0s
 => [internal] load build context                                                       0.0s
 => => transferring context: 128B                                                       0.0s
 => CACHED [2/7] WORKDIR /app                                                           0.0s
 => CACHED [3/7] RUN addgroup -S appgroup && adduser -S appuser -G appgroup             0.0s
 => [4/7] RUN chown -R appuser:appgroup /app                                            0.3s
 => [5/7] COPY --chown=appuser:appgroup package*.json ./                                0.1s
 => [6/7] RUN npm ci --omit=dev                                                         2.5s
 => [7/7] COPY --chown=appuser:appgroup src/ ./src/                                     0.1s
 => exporting to image                                                                  0.9s
 => => exporting layers                                                                 0.3s
 => => exporting manifest sha256:1b90fc2623a9b58242163917f6b961ffb964afa3c12300e7e731f  0.0s
 => => exporting config sha256:66cf796363a543775eff2161ec2b97000dc88fe6421d9050b43eb2a  0.0s
 => => exporting attestation manifest sha256:a40f2606d3fb8eb87509346002dc8ea8d899a0095  0.0s
 => => exporting manifest list sha256:593d7612b2b054bc7dc76e9bbd53937f8aa86aaf45b178f9  0.0s
 => => naming to docker.io/library/job03-api:latest                                     0.0s
 => => unpacking to docker.io/library/job03-api:latest 



curl http://localhost:3000
{"environment":"production","port":"3000","database":{"host":"mysql","port":"3306","name":"myapp","user":"myuser"}}

il faut remplacer la directive tmpfs courte par la syntaxe longue des volumes
    volumes:
      - type: tmpfs
        target: /tmp
        tmpfs:
          mode: "1777"

          curl http://localhost:3000/test-tmp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
</head>
<body>
<pre>Cannot GET /test-tmp</pre>
</body>
</html>