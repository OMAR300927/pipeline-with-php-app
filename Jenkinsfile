pipeline {
    agent any
    
    environment {
        SCANNER_HOME = tool 'sonar-scanner'
    }

    stages {
        stage('Git checkout') {
            steps {
                git 'https://github.com/OMAR300927/pipeline-with-php-app'
            }
        }
        
        stage('SonarQube analysis') {
            steps {
                withSonarQubeEnv('sonar') {
                    sh '''
                    $SCANNER_HOME/bin/sonar-scanner \
                    -Dsonar.projectName=phpApp \
                    -Dsonar.projectKey=phpApp
                    '''
                }
            }
        }
        
        stage('Quality Gate') {
            steps {
                waitForQualityGate abortPipeline: false, credentialsId: 'sonar-cred'
            }
        }
        
        stage('File system scan') {
            steps {
                sh 'trivy fs . --format table -o fs-report.html'
            }
        }
        
        stage('Build & tag the image') {
            steps {
                sh 'docker build -t omarsa999/backendimage:latest ./backend'
                sh 'docker build -t omarsa999/frontendimage:latest ./frontend'
            }
        }
        
        stage('Scan the image') {
            steps {
                sh 'trivy image --timeout 10m --format table -o fs-report.html omarsa999/backendimage:latest'
                sh 'trivy image --timeout 10m --format table -o fs-report.html omarsa999/frontendimage:latest'
            }
        }
        
        stage('Push the image') {
            steps {
                withDockerRegistry(credentialsId: 'dockerhub', url: 'https://index.docker.io/v1/') {
                    sh 'docker push omarsa999/backendimage:latest'
                    sh 'docker push omarsa999/frontendimage:latest'
                }
            }
        }
        
        stage('Apply Kubernetes files') {
            steps {
                withKubeConfig([credentialsId: 'Kubeconfig']) { 
                    sh 'kubectl apply -f ./K8s/'
                }
            }
        }
    }
}
