<?php
// blog-post.php
require_once __DIR__ . '/includes/header.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header("Location: blog.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 1");
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
} catch (PDOException $e) {
    $post = null;
}

if (!$post) {
    header("Location: blog.php");
    exit();
}

// Fetch other posts for sidebar
try {
    $stmt = $pdo->prepare("SELECT title, slug, published_at FROM blog_posts WHERE slug != ? AND status = 1 ORDER BY published_at DESC LIMIT 4");
    $stmt->execute([$slug]);
    $recent = $stmt->fetchAll();
} catch (PDOException $e) {
    $recent = [];
}
?>

    <div class="container" style="margin-top: 40px; margin-bottom: 60px;">
        <div style="font-size:0.85rem; color:var(--text-muted); margin-bottom:25px;">
            <a href="index.php">Home</a> &nbsp;/&nbsp; 
            <a href="blog.php">Blog</a> &nbsp;/&nbsp; 
            <span style="color:var(--text-primary);"><?php echo htmlspecialchars($post['title']); ?></span>
        </div>

        <div style="display:grid; grid-template-columns: 2.2fr 1fr; gap:40px; align-items:start;">
            <!-- Article Body -->
            <article class="glass-card" style="padding: 40px; border-radius: 8px;">
                <span class="blog-card-badge" style="position:static; margin-bottom:15px; display:inline-block;"><?php echo htmlspecialchars($post['category_tag']); ?></span>
                
                <h1 style="font-size:2.4rem; line-height:1.2; margin: 10px 0 15px 0; color:#fff;"><?php echo htmlspecialchars($post['title']); ?></h1>
                
                <div style="font-size:0.85rem; color:var(--text-muted); margin-bottom:20px;">
                    <i class="far fa-calendar-alt" style="margin-right:5px;"></i> Published on <?php echo date('F d, Y', strtotime($post['published_at'])); ?>
                </div>

                <!-- Social Share Buttons -->
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:25px; padding:14px 18px; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06); border-radius:8px;">
                    <span style="font-size:0.78rem; color:rgba(255,255,255,0.45); font-weight:600; text-transform:uppercase; letter-spacing:0.5px; margin-right:4px;">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonical_url); ?>" target="_blank" rel="noopener noreferrer" title="Share on Facebook" style="width:34px; height:34px; border-radius:8px; background:rgba(59,89,152,0.15); border:1px solid rgba(59,89,152,0.25); display:flex; align-items:center; justify-content:center; color:#3b5998; font-size:0.85rem; text-decoration:none; transition:all 0.2s;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($canonical_url); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener noreferrer" title="Share on Twitter" style="width:34px; height:34px; border-radius:8px; background:rgba(29,161,242,0.15); border:1px solid rgba(29,161,242,0.25); display:flex; align-items:center; justify-content:center; color:#1da1f2; font-size:0.85rem; text-decoration:none; transition:all 0.2s;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' ' . $canonical_url); ?>" target="_blank" rel="noopener noreferrer" title="Share on WhatsApp" style="width:34px; height:34px; border-radius:8px; background:rgba(37,211,102,0.15); border:1px solid rgba(37,211,102,0.25); display:flex; align-items:center; justify-content:center; color:#25d366; font-size:0.85rem; text-decoration:none; transition:all 0.2s;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($canonical_url); ?>&title=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener noreferrer" title="Share on LinkedIn" style="width:34px; height:34px; border-radius:8px; background:rgba(0,119,181,0.15); border:1px solid rgba(0,119,181,0.25); display:flex; align-items:center; justify-content:center; color:#0077b5; font-size:0.85rem; text-decoration:none; transition:all 0.2s;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://t.me/share/url?url=<?php echo urlencode($canonical_url); ?>&text=<?php echo urlencode($post['title']); ?>" target="_blank" rel="noopener noreferrer" title="Share on Telegram" style="width:34px; height:34px; border-radius:8px; background:rgba(0,136,204,0.15); border:1px solid rgba(0,136,204,0.25); display:flex; align-items:center; justify-content:center; color:#0088cc; font-size:0.85rem; text-decoration:none; transition:all 0.2s;">
                        <i class="fab fa-telegram-plane"></i>
                    </a>
                    <button onclick="copyBlogLink()" id="copy-link-btn" title="Copy Link" style="width:34px; height:34px; border-radius:8px; background:rgba(212,175,55,0.1); border:1px solid rgba(212,175,55,0.2); display:flex; align-items:center; justify-content:center; color:#D4AF37; font-size:0.85rem; cursor:pointer; transition:all 0.2s;">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
                <script>
                function copyBlogLink() {
                    navigator.clipboard.writeText('<?php echo $canonical_url; ?>').then(function() {
                        var btn = document.getElementById('copy-link-btn');
                        btn.innerHTML = '<i class="fas fa-check"></i>';
                        btn.style.background = 'rgba(74,222,128,0.15)';
                        btn.style.borderColor = 'rgba(74,222,128,0.3)';
                        btn.style.color = '#4ade80';
                        setTimeout(function() {
                            btn.innerHTML = '<i class="fas fa-link"></i>';
                            btn.style.background = 'rgba(212,175,55,0.1)';
                            btn.style.borderColor = 'rgba(212,175,55,0.2)';
                            btn.style.color = '#D4AF37';
                        }, 2000);
                    });
                }
                </script>

                <?php if ($post['cover_image']): ?>
                    <div style="width:100%; border-radius:14px; margin-bottom:35px; border:1px solid rgba(212,175,55,0.12); overflow:hidden; background:#0c0e12; display:flex; align-items:center; justify-content:center; padding:24px;">
                        <img src="<?php echo htmlspecialchars($post['cover_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" style="max-width:100%; height:auto; max-height:500px; object-fit:contain; border-radius:8px; display:block;">
                    </div>
                <?php endif; ?>

                <!-- Article Content -->
                <div class="blog-content-body" style="line-height:1.8; font-size:1.05rem; color:rgba(255,255,255,0.6);">
                    <?php echo $post['body']; ?>
                </div>

<style>
/* ── Blog Post Typography ── */
.blog-content-body { max-width:100%; }

.blog-content-body p {
    margin-bottom: 1.4em;
    color: rgba(255,255,255,0.68);
    line-height: 1.85;
    font-size: 1rem;
}
.blog-content-body h1,
.blog-content-body h2 {
    font-family: var(--font-heading);
    font-weight: 800;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 1.8em 0 0.6em;
    line-height: 1.15;
}
.blog-content-body h1 { font-size: 1.7rem; }
.blog-content-body h2 { font-size: 1.35rem; }
.blog-content-body h3 {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--gold-primary);
    margin: 1.5em 0 0.5em;
    letter-spacing: 0.4px;
}
.blog-content-body h4,
.blog-content-body h5 {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1rem;
    color: rgba(255,255,255,0.9);
    margin: 1.3em 0 0.4em;
}
.blog-content-body strong,
.blog-content-body b {
    color: #fff;
    font-weight: 700;
}
.blog-content-body em,
.blog-content-body i {
    color: rgba(255,255,255,0.75);
    font-style: italic;
}
.blog-content-body ul,
.blog-content-body ol {
    margin: 0.8em 0 1.4em 0;
    padding-left: 0;
    list-style: none;
}
.blog-content-body ul li,
.blog-content-body ol li {
    position: relative;
    padding: 6px 0 6px 28px;
    color: rgba(255,255,255,0.65);
    font-size: 0.97rem;
    line-height: 1.7;
    border-bottom: 1px solid rgba(255,255,255,0.04);
}
.blog-content-body ul li::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--gold-gradient);
}
.blog-content-body ol {
    counter-reset: list-counter;
}
.blog-content-body ol li {
    counter-increment: list-counter;
}
.blog-content-body ol li::before {
    content: counter(list-counter);
    position: absolute;
    left: 0;
    top: 6px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(212,175,55,0.12);
    border: 1px solid rgba(212,175,55,0.2);
    color: var(--gold-primary);
    font-size: 0.68rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    text-align: center;
}
.blog-content-body blockquote {
    margin: 1.8em 0;
    padding: 18px 24px;
    border-left: 3px solid var(--gold-primary);
    background: rgba(212,175,55,0.04);
    border-radius: 0 12px 12px 0;
    color: rgba(255,255,255,0.75);
    font-style: italic;
    font-size: 1.02rem;
    line-height: 1.75;
}
.blog-content-body a {
    color: var(--gold-primary);
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: color 0.2s;
}
.blog-content-body a:hover { color: #fff; }
.blog-content-body img {
    max-width: 100%;
    border-radius: 12px;
    margin: 1.4em 0;
    border: 1px solid rgba(212,175,55,0.1);
}
.blog-content-body hr {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.07);
    margin: 2em 0;
}
.blog-content-body code {
    background: rgba(212,175,55,0.08);
    border: 1px solid rgba(212,175,55,0.15);
    padding: 2px 8px;
    border-radius: 5px;
    font-size: 0.88em;
    color: var(--gold-primary);
}
.blog-content-body pre {
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    padding: 18px 20px;
    overflow-x: auto;
    margin: 1.4em 0;
}
</style>
            </article>

            <!-- Sidebar -->
            <aside style="display:flex; flex-direction:column; gap:25px;">
                <!-- Recent Articles -->
                <?php if (!empty($recent)): ?>
                    <div class="glass-card" style="padding: 25px; border-radius:8px;">
                        <h3 style="font-size:1.1rem; text-transform:uppercase; margin-bottom:15px; border-bottom:1px solid var(--border-color); padding-bottom:10px; color:var(--gold-primary);">Recent Articles</h3>
                        <div style="display:flex; flex-direction:column; gap:15px;">
                            <?php foreach ($recent as $rec): ?>
                                <div>
                                    <a href="blog-post.php?slug=<?php echo $rec['slug']; ?>" style="font-weight:700; font-size:0.95rem; color:#fff; display:block; line-height:1.3; margin-bottom:4px;">
                                        <?php echo htmlspecialchars($rec['title']); ?>
                                    </a>
                                    <span style="font-size:0.75rem; color:var(--text-muted);"><?php echo date('M d, Y', strtotime($rec['published_at'])); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Promotional banner inside blog -->
                <div class="glass-card" style="padding:25px; border-radius:8px; text-align:center; background:linear-gradient(135deg, rgba(212,175,55,0.05) 0%, rgba(8,12,16,0.9) 100%);">
                    <h4 style="font-size:1.2rem; text-transform:uppercase; margin-bottom:10px; color:var(--gold-primary);">Wolfpack Supplement</h4>
                    <p style="font-size:0.85rem; margin-bottom:15px;">Increase testosterone, stamina & peak vitality naturally.</p>
                    <a href="product.php?slug=wolfpack-unleash-the-alpha-within" class="btn-gold" style="padding:8px 20px; font-size:0.8rem;">View Pack</a>
                </div>
            </aside>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
