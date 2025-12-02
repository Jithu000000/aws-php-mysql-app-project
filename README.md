🚀 AWS DevOps Project — 3-Tier Architecture with CI/CD (GitHub Actions → EC2)

This project implements a production-style AWS 3-Tier Architecture with a fully automated CI/CD pipeline using GitHub Actions.
It includes networking, compute, load balancing, database, automation, and secure deployment workflows.

🧱 Architecture Overview




                     ┌─────────────────────────────┐
                     │         AWS Region           │
                     └─────────────────────────────┘

┌────────────────────────────── VPC (10.0.0.0/16) ──────────────────────────────┐

  Public Subnet A                  Public Subnet B
┌───────────────────┐          ┌───────────────────┐
│ Bastion Host      │          │ Application LB     │
│ (SSH from laptop) │◄────────►│  HTTP/HTTPS        │
└───────────────────┘          └───────────────────┘
                                    │
                                    ▼

                     Private Subnet (App Tier)
              ┌────────────────────────────────────┐
              │ EC2 Instance (Apache + PHP App)     │
              │ Receives traffic only from ALB      │
              │ Deployed automatically via CI/CD     │
              └────────────────────────────────────┘
                                    │
                                    ▼

                     Private Subnet (DB Tier)
              ┌────────────────────────────────────┐
              │ MySQL Database Server (EC2)         │
              │ Accessible only from App EC2        │
              └────────────────────────────────────┘

└───────────────────────────────────────────────────────────────────────────────┘





✨ Features Implemented
🔹 1. VPC & Secure Networking

Custom VPC (10.0.0.0/16)

Public + Private Subnet Architecture

Internet Gateway + NAT Gateway

Bastion Host for secure SSH access

Route tables for controlled traffic flow

Strict Security Groups (least privilege)

🔹 2. Application Layer

EC2 instance running Amazon Linux

Apache + PHP installed

Application code deployed automatically

Connected to private MySQL DB EC2

🔹 3. Database Layer

MySQL installed on private EC2

Secure internal access only

PHP app successfully connects using mysqli

Verified DB queries (SELECT NOW())

🔹 4. Load Balancing

Application Load Balancer (ALB)

Target groups with health checks

Routes internet traffic → ALB → App EC2

No direct exposure to the app server

🔹 5. CI/CD Pipeline (GitHub Actions → EC2)

Automated deployment includes:

Developer pushes code to GitHub

GitHub Actions workflow triggers

Workflow:

Connects to EC2 via SSH

Syncs files using rsync

Copies app → /var/www/html/

Restarts Apache

ALB immediately serves the updated application

CI/CD is fully automated — zero manual deployment.

📁 Repository Structure
/
├── index.php
├── .github/
│   └── workflows/
│       └── deploy.yml
└── README.md

🚀 Deployment Workflow (.github/workflows/deploy.yml)

The CI/CD pipeline performs:

SSH key setup

Rsync application files to EC2

Copy files to Apache doc root

Restart Apache service

Instant ALB-level deployment

Excerpt:

name: Deploy PHP App to EC2

on:
  push:
    branches:
      - main
  workflow_dispatch:

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Prepare SSH key
        run: |
          mkdir -p ~/.ssh
          echo "$EC2_SSH_KEY" > ~/.ssh/ec2_key
          chmod 600 ~/.ssh/ec2_key


(Followed by rsync and deploy steps)

🔧 How to Push New Changes

Just update your code and run:

git add .
git commit -m "Update app"
git push origin main


GitHub Actions will auto-deploy the update to your EC2.

✔️ Live Application Output Example
Deployment Successful! 🚀
Time from DB: 2025-12-02 13:36:26
Served from host: ip-10-0-1-102.ec2.internal

📌 Next Enhancements (To Be Added)

CloudWatch metrics & dashboards

Log monitoring & alarms

SNS email notifications

Auto Scaling Group (ASG) integration

Terraform/IaC automation

🎉 Author

Shreejith
Aspiring AWS & DevOps Engineer

🏷️ Tags

AWS DevOps CI/CD GitHub Actions EC2 VPC MySQL Load Balancer Automation
