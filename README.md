# PHP Demo Project: CI/CD Pipeline for Deploying and Monitoring a PHP Application

Simulating an AWS-like environment by using Docker Compose to build and deploy a PHP application with Docker, Jenkins, Trivy, SonarQube, Kubernetes, ArgoCD, Prometheus, and Grafana inside the cluster.

---

# Prerequisites

Make sure you have the following tools installed:

* PHP application
* Git and GitHub
* Docker & Docker Compose
* Trivy
* SonarQube
* Jenkins
* Kubernetes (Minikube)
* ArgoCD
* Prometheus
* Grafana

---

# Steps in the CI/CD Pipeline

1. Get the PHP application.
2. Dockerize the frontend and backend of the PHP application.
3. Create a Docker Compose file to run Jenkins and SonarQube containers.
4. Create a Dockerfile for Jenkins to install the tools I need.
5. Push all Dockerfiles to the repository.
6. Go to SonarQube and create a token.
7. Use the token to create credentials in Jenkins and add the SonarQube server.
8. Write the Jenkinsfile.
9. Set up Kubernetes on a host using Minikube.
10. Create Kubernetes Deployment and Service for the frontend.
11. Create Kubernetes Deployment and Service for the backend.
12. Create Kubernetes Deployment, Service, and PersistentVolume for MySQL DB.
13. Create a Kubernetes Ingress to expose the frontend externally.
14. Create a Kubernetes Deployment, Service, and Secret for MySQL Exporter.
15. Create a Kubernetes ServiceMonitor for the backend and MySQL DB.
16. Create a Kubernetes ConfigMap file.
17. Use Jenkins to deploy the Kubernetes cluster.
18. Use ArgoCD and connect it to the repository.
19. Use Prometheus and Grafana to monitor the backend and MySQL DB.

---

# Pipeline Steps

**Inside Jenkinsfile:**

`Checkout --> SonarQube analysis --> Quality gate --> Scan file system --> Build & tag image --> Scan the image --> Push the image --> Apply Kubernetes cluster`

**Outside Jenkinsfile:**

Use ArgoCD and monitor the application using Prometheus and Grafana.

---

## Project Structure

| File                      | Description |
|---------------------------|--------------------------------------------------------------|
| backend/                  | Contains backend files and its Dockerfile                    |
| db/                       | Contains MySQL DB files                                      |
| frontend/                 | Contains frontend files and its Dockerfile                   |
| K8s/                      | Contains Kubernetes manifests (cluster files)                |
| Jenkinsfile               | Jenkins pipeline script                                      |
| Dockerfile                | Jenkins Dockerfile to install required tools                 |
| docker-compose-tools.yml  | Docker Compose file for Jenkins and SonarQube containers     |

---

## Conclusion

* I used Docker Hub credentials in Jenkins.
* After deploying the application, run `minikube service fr-service` to access it in the browser.
* Or you can use `minikube tunnel` to access it, but if you use this method, you also need to update your `/etc/hosts` file.

---

## Notes

* I created the MySQL DB secret from the command line.  
* I used Gitleaks at the beginning but had some issues with MySQL Exporter, so I removed the Gitleaks stage and created the secret manually.  
  You can try to add the Gitleaks stage again by creating the MySQL Exporter secret file and referencing it in the Jenkinsfile.  
* When you start Prometheus, you’ll see the backend target appear but it won’t scrape metrics.  
  That’s because the backend script needs small changes to expose metrics.  
* In ArgoCD, the Ingress health may stay “in progress” because the Minikube tunnel wasn’t opened.
