@echo off
echo ========================================
echo    MONEY MENTOR PRO - GITHUB UPLOAD
echo ========================================
echo.

echo Checking Git installation...
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo Git is not installed. Installing Git...
    echo.
    echo Please download and install Git from: https://git-scm.com/download/win
    echo After installation, run this script again.
    echo.
    pause
    exit /b 1
)

echo Git found! Proceeding with GitHub upload...
echo.

echo Initializing Git repository...
git init

echo Adding all files to Git...
git add .

echo Creating initial commit...
git commit -m "Initial commit: Money Mentor Pro - Platform Literasi Finansial dan Investasi"

echo Adding remote repository...
git remote add origin https://github.com/fajar-26/Project_301220026_FajarMunawar.git

echo Pushing to GitHub...
git branch -M main
git push -u origin main

if %errorlevel% neq 0 (
    echo.
    echo ERROR: Failed to push to GitHub
    echo Please check:
    echo 1. You have access to the repository
    echo 2. Your GitHub credentials are configured
    echo 3. The repository URL is correct
    echo.
    echo To configure Git credentials:
    echo git config --global user.name "Your Name"
    echo git config --global user.email "your.email@example.com"
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo    UPLOAD COMPLETED SUCCESSFULLY!
echo ========================================
echo.
echo Repository: https://github.com/fajar-26/Project_301220026_FajarMunawar.git
echo.
echo Next steps:
echo 1. Visit your GitHub repository
echo 2. Add README.md and documentation
echo 3. Set up GitHub Pages (optional)
echo.
pause 