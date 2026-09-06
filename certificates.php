<?php
// certificates.php
require_once __DIR__ . '/includes/header.php';
$certs = get_certificates();
?>

<style>
#goldParticles{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0;opacity:0.3;}

/* ── Hero ── */
.cert-hero{position:relative;padding:90px 0 70px;overflow:hidden;background:radial-gradient(ellipse at 50% 30%,rgba(212,175,55,0.07) 0%,transparent 60%),linear-gradient(180deg,#080C10 0%,#121212 100%);text-align:center;}
.cert-hero::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:500px;height:500px;border-radius:50%;border:1px solid rgba(212,175,55,0.06);animation:heroRing 22s linear infinite;pointer-events:none;}
.cert-hero::after{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:340px;height:340px;border-radius:50%;border:1px solid rgba(212,175,55,0.04);animation:heroRing 15s linear infinite reverse;pointer-events:none;}
@keyframes heroRing{from{transform:translate(-50%,-50%) rotate(0deg);}to{transform:translate(-50%,-50%) rotate(360deg);}}

/* ── Trust Badges (top strip) ── */
.cert-trust-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin:0 0 60px;}
.cert-trust-item{display:flex;flex-direction:column;align-items:center;gap:12px;padding:28px 20px;background:rgba(255,255,255,0.02);border:1px solid rgba(212,175,55,0.08);border-radius:18px;text-align:center;transition:all 0.35s;position:relative;overflow:hidden;}
.cert-trust-item::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--gold-gradient);opacity:0;transition:opacity 0.3s;}
.cert-trust-item:hover{border-color:var(--gold-primary);transform:translateY(-5px);box-shadow:0 14px 35px rgba(8,12,16,0.4);}
.cert-trust-item:hover::before{opacity:1;}
.cert-trust-icon{width:54px;height:54px;border-radius:14px;background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.18);display:flex;align-items:center;justify-content:center;color:var(--gold-primary);font-size:1.3rem;transition:all 0.3s;}
.cert-trust-item:hover .cert-trust-icon{background:rgba(212,175,55,0.14);border-color:var(--gold-primary);}
.cert-trust-title{font-family:var(--font-heading);font-weight:700;font-size:0.95rem;color:#fff;text-transform:uppercase;letter-spacing:0.5px;}
.cert-trust-desc{font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.55;}

/* ── Cert Grid ── */
.cert-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px;margin-bottom:70px;}
.cert-card{background:rgba(255,255,255,0.02);border:1px solid rgba(212,175,55,0.1);border-radius:20px;overflow:hidden;transition:all 0.4s;position:relative;cursor:pointer;}
.cert-card:hover{border-color:var(--gold-primary);transform:translateY(-6px);box-shadow:0 18px 45px rgba(8,12,16,0.5),0 0 30px rgba(212,175,55,0.08);}
.cert-card::after{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:0;height:2px;background:var(--gold-gradient);transition:width 0.4s;border-radius:2px;}
.cert-card:hover::after{width:80%;}
.cert-card-img{position:relative;overflow:hidden;background:radial-gradient(circle at center,rgba(212,175,55,0.05) 0%,rgba(8,12,16,0.95) 80%);display:flex;align-items:center;justify-content:center;min-height:240px;}
.cert-card-img img{width:100%;height:240px;object-fit:cover;display:block;transition:transform 0.45s ease;}
.cert-card:hover .cert-card-img img{transform:scale(1.05);}
.cert-card-img .cert-zoom-hint{position:absolute;inset:0;background:rgba(8,12,16,0.55);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.3s;}
.cert-card:hover .cert-zoom-hint{opacity:1;}
.cert-zoom-hint i{font-size:1.8rem;color:var(--gold-primary);}
.cert-card-pdf{min-height:240px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;padding:30px;background:linear-gradient(135deg,rgba(212,175,55,0.06) 0%,rgba(8,12,16,0.98) 100%);transition:background 0.3s;}
.cert-card:hover .cert-card-pdf{background:linear-gradient(135deg,rgba(212,175,55,0.1) 0%,rgba(8,12,16,0.98) 100%);}
.cert-card-pdf .pdf-icon{width:72px;height:72px;border-radius:50%;background:rgba(212,175,55,0.1);border:1px solid rgba(212,175,55,0.2);display:flex;align-items:center;justify-content:center;transition:all 0.3s;}
.cert-card:hover .cert-card-pdf .pdf-icon{background:rgba(212,175,55,0.16);border-color:var(--gold-primary);transform:scale(1.1);}
.cert-card-pdf .pdf-icon i{font-size:2rem;color:var(--gold-primary);}
.cert-card-pdf p{font-size:0.82rem;color:rgba(255,255,255,0.5);text-align:center;}
.cert-card-body{padding:20px 22px 22px;}
.cert-card-name{font-family:var(--font-heading);font-weight:700;font-size:1rem;color:#fff;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.4px;}
.cert-card-meta{font-size:0.78rem;color:rgba(255,255,255,0.4);display:flex;align-items:center;gap:6px;}
.cert-card-meta i{color:var(--gold-primary);font-size:0.72rem;}

/* ── PDF badge ── */
.cert-pdf-badge{position:absolute;top:14px;left:14px;background:rgba(212,175,55,0.15);border:1px solid rgba(212,175,55,0.3);color:var(--gold-primary);font-size:0.62rem;font-weight:800;letter-spacing:1px;padding:4px 10px;border-radius:6px;text-transform:uppercase;z-index:2;}

/* ── Verified badge ── */
.cert-verified-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(46,204,113,0.08);border:1px solid rgba(46,204,113,0.15);color:#2ecc71;font-size:0.7rem;font-weight:700;padding:5px 12px;border-radius:20px;text-transform:uppercase;letter-spacing:0.5px;}

/* ── Empty state ── */
.cert-empty{text-align:center;padding:80px 20px;background:rgba(255,255,255,0.02);border:1px dashed rgba(212,175,55,0.15);border-radius:20px;}
.cert-empty i{font-size:3rem;color:rgba(212,175,55,0.2);margin-bottom:18px;display:block;}
.cert-empty h3{font-size:1.2rem;color:rgba(255,255,255,0.5);margin-bottom:8px;}
.cert-empty p{font-size:0.88rem;color:rgba(255,255,255,0.3);}

/* ── CTA Banner ── */
.cta-banner{background:linear-gradient(135deg,rgba(212,175,55,0.07) 0%,rgba(8,12,16,0.95) 50%,rgba(212,175,55,0.04) 100%);border:1px solid rgba(212,175,55,0.12);border-radius:24px;padding:60px 50px;text-align:center;position:relative;overflow:hidden;margin:0 0 80px;}
.cta-banner::before{content:'';position:absolute;top:-70px;right:-70px;width:250px;height:250px;background:radial-gradient(circle,rgba(212,175,55,0.08) 0%,transparent 70%);pointer-events:none;}
.cta-banner::after{content:'';position:absolute;bottom:-50px;left:-50px;width:200px;height:200px;background:radial-gradient(circle,rgba(212,175,55,0.06) 0%,transparent 70%);pointer-events:none;}

/* ── Modal ── */
.cert-modal{position:fixed;inset:0;background:rgba(8,12,16,0.95);z-index:9000;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity 0.25s ease;backdrop-filter:blur(12px);}
.cert-modal.open{opacity:1;pointer-events:auto;}
.cert-modal-close{position:absolute;top:20px;right:24px;width:42px;height:42px;border-radius:10px;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.08);color:#fff;font-size:1.1rem;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s;}
.cert-modal-close:hover{background:rgba(212,175,55,0.1);border-color:var(--gold-primary);color:var(--gold-primary);}
.cert-modal img{max-width:88%;max-height:78vh;border-radius:10px;box-shadow:0 0 60px rgba(0,0,0,0.7);border:1px solid rgba(212,175,55,0.12);}
.cert-modal-title{margin-top:20px;font-family:var(--font-heading);font-size:1.05rem;font-weight:700;color:var(--gold-primary);text-transform:uppercase;letter-spacing:0.5px;}

/* ── Responsive ── */
@media(max-width:900px){
    .cert-grid{grid-template-columns:repeat(2,1fr);}
    .cert-trust-strip{grid-template-columns:1fr;}
    .cta-banner{padding:40px 30px;}
}
@media(max-width:600px){
    body{overflow-x:hidden;}
    #goldParticles{display:none !important;}
    .cert-hero{padding:60px 0 50px;}
    .cert-grid{grid-template-columns:1fr;gap:18px;}
    .cert-trust-strip{gap:14px;}
    .cta-banner{padding:30px 20px;}
    .cta-banner h3{font-size:1.4rem;}
}
</style>

<canvas id="goldParticles"></canvas>

<!-- ═══ HERO ═══ -->
<section class="cert-hero">
    <div style="position:relative;z-index:2;padding:0 20px;">
        <span style="display:inline-block;font-size:0.68rem;font-weight:800;letter-spacing:2.5px;background:var(--gold-gradient);color:#080C10;padding:6px 18px;border-radius:20px;text-transform:uppercase;margin-bottom:20px;">Verified & Certified</span>
        <h1 style="font-size:clamp(2.2rem,5vw,3.8rem);font-family:var(--font-heading);font-weight:800;text-transform:uppercase;line-height:1.1;color:#fff;letter-spacing:1.5px;margin-bottom:14px;">
            Quality You Can
            <span style="display:block;background:var(--gold-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Trust & Verify</span>
        </h1>
        <p style="font-size:1rem;color:rgba(255,255,255,0.6);max-width:560px;margin:0 auto 28px;line-height:1.75;">Every certificate below is real, verified, and up to date. We believe in complete transparency — you deserve to know exactly what goes into your body.</p>
        <span class="cert-verified-badge"><i class="fas fa-check-circle"></i> All Certificates Authentic</span>
    </div>
</section>

<div class="container" style="position:relative;z-index:2;margin-top:60px;">

    <!-- ═══ TRUST BADGES ═══ -->
    <div class="cert-trust-strip reveal-el">
        <div class="cert-trust-item tilt-card spotlight-card">
            <div class="tilt-shine"></div>
            <div class="cert-trust-icon"><i class="fas fa-shield-halved"></i></div>
            <div class="cert-trust-title">FSSAI Licensed</div>
            <div class="cert-trust-desc">Registered under India's Food Safety & Standards Authority. Every batch is compliant.</div>
        </div>
        <div class="cert-trust-item tilt-card spotlight-card">
            <div class="tilt-shine"></div>
            <div class="cert-trust-icon"><i class="fas fa-flask"></i></div>
            <div class="cert-trust-title">Lab Tested</div>
            <div class="cert-trust-desc">Third-party tested for purity, potency, and zero heavy metal contamination.</div>
        </div>
        <div class="cert-trust-item tilt-card spotlight-card">
            <div class="tilt-shine"></div>
            <div class="cert-trust-icon"><i class="fas fa-leaf"></i></div>
            <div class="cert-trust-title">100% Ayurvedic</div>
            <div class="cert-trust-desc">Veggie capsules, zero synthetic compounds. Pure Himalayan botanical extracts only.</div>
        </div>
    </div>

    <!-- ═══ SECTION HEADER ═══ -->
    <div style="text-align:center;margin-bottom:40px;" class="reveal-el">
        <span style="display:inline-block;font-size:0.65rem;font-weight:800;letter-spacing:2.5px;color:var(--gold-primary);text-transform:uppercase;margin-bottom:12px;background:rgba(212,175,55,0.06);border:1px solid rgba(212,175,55,0.12);padding:5px 16px;border-radius:20px;">Our Certifications</span>
        <h2 style="font-size:clamp(1.8rem,4vw,2.6rem);font-family:var(--font-heading);font-weight:800;color:#fff;text-transform:uppercase;margin-bottom:10px;">Official Documents</h2>
        <p style="font-size:0.95rem;color:rgba(255,255,255,0.5);max-width:480px;margin:0 auto;">Click any certificate to view it in full size. PDFs open in a new tab.</p>
    </div>

    <!-- ═══ CERT GRID ═══ -->
    <?php if (!empty($certs)): ?>
        <div class="cert-grid">
            <?php foreach ($certs as $cert):
                $is_pdf = strtolower(pathinfo($cert['image_url'], PATHINFO_EXTENSION)) === 'pdf';
            ?>
                <div class="cert-card tilt-card spotlight-card reveal-el"
                     <?php if (!$is_pdf): ?>onclick="openCertModal('<?php echo htmlspecialchars($cert['image_url'], ENT_QUOTES); ?>','<?php echo htmlspecialchars($cert['title'], ENT_QUOTES); ?>')"<?php endif; ?>>
                    <div class="tilt-shine"></div>

                    <!-- Image / PDF Preview -->
                    <?php if ($is_pdf): ?>
                        <span class="cert-pdf-badge"><i class="fas fa-file-pdf"></i> PDF</span>
                        <a href="<?php echo htmlspecialchars($cert['image_url']); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration:none;" onclick="event.stopPropagation()">
                            <div class="cert-card-pdf">
                                <div class="pdf-icon"><i class="fas fa-file-pdf"></i></div>
                                <p>Click to open certificate PDF</p>
                                <span style="display:inline-flex;align-items:center;gap:6px;color:var(--gold-primary);font-size:0.78rem;font-weight:700;margin-top:4px;"><i class="fas fa-external-link-alt"></i> Open PDF</span>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="cert-card-img">
                            <img src="<?php echo htmlspecialchars($cert['image_url']); ?>" alt="<?php echo htmlspecialchars($cert['title']); ?> — Wolf Nutrition Certificate" loading="lazy">
                            <div class="cert-zoom-hint"><i class="fas fa-search-plus"></i></div>
                        </div>
                    <?php endif; ?>

                    <!-- Card Body -->
                    <div class="cert-card-body">
                        <div class="cert-card-name"><?php echo htmlspecialchars($cert['title']); ?></div>
                        <div class="cert-card-meta">
                            <i class="fas fa-circle-check"></i>
                            <?php echo $is_pdf ? 'Official Document' : 'Verified Certificate'; ?>
                            <?php if (!$is_pdf): ?>
                                &nbsp;&middot;&nbsp;<span style="color:rgba(255,255,255,0.3);">Click to enlarge</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <div class="cert-empty reveal-el">
            <i class="fas fa-certificate"></i>
            <h3>Certificates Coming Soon</h3>
            <p>We're uploading our official documents. Check back shortly.</p>
        </div>
    <?php endif; ?>

    <!-- Divider -->
    <div style="position:relative;width:100%;overflow:hidden;line-height:0;margin:20px 0 60px;"><svg viewBox="0 0 1200 50" preserveAspectRatio="none" style="display:block;width:100%;height:40px;"><path d="M0,0 L1200,0 L1200,25 Q900,50 600,25 Q300,0 0,25 Z" fill="rgba(212,175,55,0.03)"/></svg></div>

    <!-- ═══ CTA BANNER ═══ -->
    <div class="cta-banner reveal-el">
        <h3 style="font-size:clamp(1.6rem,4vw,2.2rem);font-family:var(--font-heading);font-weight:800;text-transform:uppercase;color:#fff;margin-bottom:12px;position:relative;z-index:2;">Transparency is Our Standard</h3>
        <p style="font-size:1rem;color:rgba(255,255,255,0.6);max-width:520px;margin:0 auto 28px;line-height:1.75;position:relative;z-index:2;">Every Wolf Nutrition product is certified, lab-tested, and FSSAI registered. Shop with complete confidence.</p>
        <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;position:relative;z-index:2;">
            <a href="category.php?slug=vitality" class="btn-gold" style="padding:14px 36px;font-size:0.92rem;border-radius:30px;"><i class="fas fa-shopping-bag"></i> Shop Supplements</a>
            <a href="about.php" class="btn-outline-gold" style="padding:13px 36px;font-size:0.92rem;border-radius:30px;">Our Story</a>
        </div>
    </div>

</div>

<!-- ═══ CERT MODAL ═══ -->
<div class="cert-modal" id="certModal">
    <button class="cert-modal-close" onclick="closeCertModal()"><i class="fas fa-times"></i></button>
    <img id="certModalImg" src="" alt="Certificate Full View">
    <div class="cert-modal-title" id="certModalTitle"></div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script>
// ── Gold Particles ──
(function(){var c=document.getElementById('goldParticles');if(!c)return;var ctx=c.getContext('2d'),p=[];function r(){c.width=window.innerWidth;c.height=window.innerHeight;}r();window.addEventListener('resize',r);for(var i=0;i<28;i++)p.push({x:Math.random()*c.width,y:Math.random()*c.height,r:Math.random()*1.6+0.4,dx:(Math.random()-0.5)*0.22,dy:(Math.random()-0.5)*0.22,o:Math.random()*0.35+0.1});function d(){ctx.clearRect(0,0,c.width,c.height);p.forEach(function(v){ctx.beginPath();ctx.arc(v.x,v.y,v.r,0,Math.PI*2);ctx.fillStyle='rgba(212,175,55,'+v.o+')';ctx.fill();v.x+=v.dx;v.y+=v.dy;if(v.x<0||v.x>c.width)v.dx*=-1;if(v.y<0||v.y>c.height)v.dy*=-1;});requestAnimationFrame(d);}d();})();

// ── Scroll Reveal ──
(function(){var els=document.querySelectorAll('.reveal-el');els.forEach(function(el){el.style.opacity='0';el.style.transform='translateY(22px)';el.style.transition='opacity 0.5s ease, transform 0.5s ease';});var obs=new IntersectionObserver(function(entries){entries.forEach(function(e,i){if(e.isIntersecting){setTimeout(function(){e.target.style.opacity='1';e.target.style.transform='translateY(0)';},i*55);obs.unobserve(e.target);}});},{threshold:0.08});els.forEach(function(el){obs.observe(el);});})();

// ── 3D Tilt ──
(function(){document.querySelectorAll('.tilt-card').forEach(function(card){card.addEventListener('mousemove',function(e){var rect=card.getBoundingClientRect();var x=(e.clientX-rect.left)/rect.width-0.5;var y=(e.clientY-rect.top)/rect.height-0.5;card.style.transform='rotateY('+(x*5)+'deg) rotateX('+(-y*5)+'deg) scale(1.02)';card.style.setProperty('--mouse-x',((e.clientX-rect.left)/rect.width*100)+'%');card.style.setProperty('--mouse-y',((e.clientY-rect.top)/rect.height*100)+'%');});card.addEventListener('mouseleave',function(){card.style.transform='';});});})();

// ── Certificate Modal ──
function openCertModal(src, title) {
    var modal = document.getElementById('certModal');
    document.getElementById('certModalImg').src = src;
    document.getElementById('certModalTitle').textContent = title;
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeCertModal() {
    var modal = document.getElementById('certModal');
    modal.classList.remove('open');
    document.body.style.overflow = '';
    // Clear src after transition
    setTimeout(function(){ document.getElementById('certModalImg').src = ''; }, 280);
}
// Close on backdrop click
document.getElementById('certModal').addEventListener('click', function(e) {
    if (e.target === this) closeCertModal();
});
// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeCertModal();
});
</script>
