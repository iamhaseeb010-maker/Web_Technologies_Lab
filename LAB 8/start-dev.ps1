Param()

# start-dev.ps1
# Automates: add Laragon PHP to PATH for this session, copy .env, generate key, run php artisan serve

Write-Host "Starting LAB 7 dev helper..."

# Helper to run a command and exit on failure
function Run-Check($cmd) {
    Write-Host "-> $cmd"
    $proc = Start-Process -FilePath pwsh -ArgumentList "-NoProfile -NoLogo -Command $cmd" -Wait -PassThru -WindowStyle Hidden -ErrorAction SilentlyContinue
    if ($proc.ExitCode -ne 0) {
        Write-Host "Command failed with exit code $($proc.ExitCode): $cmd" -ForegroundColor Red
        return $false
    }
    return $true
}

# 1) Ensure PHP available in this session; if not, try Laragon's PHP
try {
    & php -v > $null 2>&1
    $phpFound = $true
} catch {
    $phpFound = $false
}

if (-not $phpFound) {
    Write-Host "php not found in PATH, searching for Laragon PHP..."
    $phpDirs = Get-ChildItem 'C:\laragon\bin\php' -Directory -ErrorAction SilentlyContinue | Select-Object -ExpandProperty FullName -ErrorAction SilentlyContinue
    if ($phpDirs -and $phpDirs.Count -gt 0) {
        $phpFolder = $phpDirs[0]
        Write-Host "Found Laragon PHP: $phpFolder"
        $env:PATH = $env:PATH + ";$phpFolder"
        Write-Host "Temporarily added PHP to PATH for this session."
        try { & php -v } catch { }
    } else {
        Write-Host "Laragon PHP not found. Please start Laragon or add PHP to PATH." -ForegroundColor Yellow
        Pause
        exit 1
    }
}

Push-Location "$(Split-Path -Path $MyInvocation.MyCommand.Definition -Parent)"

if (-not (Test-Path .env)) {
    if (Test-Path .env.example) {
        Copy-Item .env.example .env -Force
        Write-Host ".env created from .env.example"
    } else {
        Write-Host "No .env.example found - create .env manually." -ForegroundColor Yellow
    }
}

Write-Host "Running: php artisan key:generate"
& php artisan key:generate

Write-Host "Starting Laravel dev server (php artisan serve). Press Ctrl+C to stop."
& php artisan serve --host=127.0.0.1 --port=8000

Pop-Location
