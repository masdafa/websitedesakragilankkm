import re
import os

filepath = r'resources\views\home.blade.php'
outdir = r'resources\views\partials\home'

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# We'll use regex or simple string split to find sections
# Let's find index of major sections
markers = {
    'hero': '<!-- HERO -->',
    'quick-access': '<!-- QUICK ACCESS CARDS -->',
    'profil': '<!-- ==============================\n     PROFIL DESA',
    'struktur': '    <!-- STRUKTUR ORGANISASI -->',
    'info-desa': '    <!-- INFO DESA -->',
    'statistik': '    <!-- STATISTIK -->',
    'panduan': '<!-- PANDUAN ALUR -->',
    'faq': '<!-- TIPS / FAQ -->',
    'layanan': '<!-- ==============================\n     LAYANAN',
    'umkm': '<!-- ==============================\n     UMKM',
    'testimoni': '<!-- ==============================\n     TESTIMONI',
    'maps': '<!-- MAPS -->'
}

def find_idx(marker):
    return content.find(marker)

indices = []
for name, marker in markers.items():
    idx = find_idx(marker)
    if idx != -1:
        indices.append((idx, name))

indices.sort(key=lambda x: x[0])

# Add the end of content marker for the last section (before @endsection)
end_idx = content.rfind('@endsection')
indices.append((end_idx, 'END'))

# Write each section to a partial
includes = []
for i in range(len(indices)-1):
    start_idx, name = indices[i]
    end_idx, _ = indices[i+1]
    
    section_content = content[start_idx:end_idx].strip() + '\n'
    
    # Let's combine info-desa and statistik into one partial or keep them separate?
    # Keep them separate is fine
    
    out_path = os.path.join(outdir, f'{name}.blade.php')
    with open(out_path, 'w', encoding='utf-8') as f:
        f.write(section_content)
        
    includes.append(f"  @include('partials.home.{name}')")
    print(f"Created partial for {name} ({len(section_content)} chars)")

# Rewrite home.blade.php
new_home = """@extends('layouts.app')

@section('content')
""" + '\n'.join(includes) + """
@endsection
"""

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(new_home)

print("home.blade.php has been refactored successfully.")
