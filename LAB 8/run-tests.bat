@echo off
setlocal

rem run-tests.bat - start Laravel server in new window, call /_test_seed, show recent logs

set APPDIR=%~dp0

echo Starting Laravel dev server in a new window...
start "Laravel" powershell -NoProfile -ExecutionPolicy Bypass -Command "cd '%APPDIR%'; php artisan serve --host=127.0.0.1 --port=8000"

echo Waiting for server to respond (30s timeout)...

powershell -NoProfile -Command "$uri='http://127.0.0.1:8000/_health'; $max=30; for ($i=0;$i -lt $max; $i++) { try { $r=Invoke-WebRequest -Uri $uri -UseBasicParsing -TimeoutSec 2 -ErrorAction Stop; if ($r.StatusCode -eq 200) { Write-Host 'Server responded'; exit 0 } } catch { Start-Sleep -Seconds 1 } }; Write-Host 'Server did not respond within timeout'; exit 1"

if %ERRORLEVEL% EQU 0 (
	echo Opening browser to: http://127.0.0.1:8000/_test_seed
	start "" "http://127.0.0.1:8000/_test_seed"
	rem Also try a silent curl call to fetch the JSON response (if curl available)
	curl -s http://127.0.0.1:8000/_test_seed >nul 2>nul || echo (curl not available or call failed)
) else (
	echo Could not reach server; opening browser anyway.
	start "" "http://127.0.0.1:8000/_test_seed"
)

:showlog
echo.
echo Recent laravel.log (last 80 lines):
powershell -NoProfile -Command "if (Test-Path '%APPDIR%storage\logs\laravel.log') { Get-Content -Path '%APPDIR%storage\logs\laravel.log' -Tail 80 } else { Write-Host 'laravel.log not found' }"

pause
