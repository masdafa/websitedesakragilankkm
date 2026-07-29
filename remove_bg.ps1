Add-Type -AssemblyName System.Drawing

$src = 'c:\Users\Dafa Yunidar\Downloads\websitekragilanzweta\laravel-desa-kragilan\public\assets\images\logo-desa.png'

$bmp = New-Object System.Drawing.Bitmap($src)
$width = $bmp.Width
$height = $bmp.Height

# Buat output bitmap 32bpp ARGB
$output = New-Object System.Drawing.Bitmap($width, $height, [System.Drawing.Imaging.PixelFormat]::Format32bppArgb)
$g = [System.Drawing.Graphics]::FromImage($output)
$g.DrawImage($bmp, 0, 0)
$g.Dispose()
$bmp.Dispose()

Write-Host "Ukuran gambar: $($width) x $($height)"

# Flood fill BFS dari tepi gambar
$visited = New-Object 'bool[,]' $width, $height
$queue = New-Object System.Collections.Generic.Queue[string]

function IsNearWhite($px) {
    return ($px.A -gt 10 -and $px.R -gt 200 -and $px.G -gt 200 -and $px.B -gt 200)
}

# Tambahkan piksel tepi yang putih ke antrian
for ($x = 0; $x -lt $width; $x++) {
    foreach ($y in @(0, ($height - 1))) {
        $px = $output.GetPixel($x, $y)
        if ((IsNearWhite $px) -and -not $visited[$x, $y]) {
            $visited[$x, $y] = $true
            $queue.Enqueue("$x,$y")
        }
    }
}
for ($y = 0; $y -lt $height; $y++) {
    foreach ($x in @(0, ($width - 1))) {
        $px = $output.GetPixel($x, $y)
        if ((IsNearWhite $px) -and -not $visited[$x, $y]) {
            $visited[$x, $y] = $true
            $queue.Enqueue("$x,$y")
        }
    }
}

Write-Host "Mulai flood fill dari $($queue.Count) titik tepi..."

# BFS flood fill
$dx = @(1, -1, 0, 0)
$dy = @(0, 0, 1, -1)

while ($queue.Count -gt 0) {
    $item = $queue.Dequeue()
    $parts = $item.Split(',')
    $cx = [int]$parts[0]
    $cy = [int]$parts[1]
    
    $output.SetPixel($cx, $cy, [System.Drawing.Color]::Transparent)
    
    for ($i = 0; $i -lt 4; $i++) {
        $nx = $cx + $dx[$i]
        $ny = $cy + $dy[$i]
        if ($nx -ge 0 -and $nx -lt $width -and $ny -ge 0 -and $ny -lt $height -and -not $visited[$nx, $ny]) {
            $px = $output.GetPixel($nx, $ny)
            if (IsNearWhite $px) {
                $visited[$nx, $ny] = $true
                $queue.Enqueue("$nx,$ny")
            }
        }
    }
}

$output.Save($src, [System.Drawing.Imaging.ImageFormat]::Png)
$output.Dispose()

Write-Host "Selesai! Background luar dihapus, teks dalam logo tetap aman."
