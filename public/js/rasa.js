(function () {
  'use strict';
  var doc = document;
  function $(s, r) { return (r || doc).querySelector(s); }
  function $$(s, r) { return Array.prototype.slice.call((r || doc).querySelectorAll(s)); }
  function esc(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }
  function rp(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }
  function load(k) { try { return JSON.parse(localStorage.getItem(k)) || {}; } catch (e) { return {}; } }
  function save(k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} }

  var cart = load('rm_cart');
  var fav = load('rm_fav');
  var step = 'list';

  /* ---------- menu mobile ---------- */
  var menuBtn = $('.menu-btn'), nav = $('#nav');
  if (menuBtn && nav) {
    menuBtn.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  /* ---------- laci ---------- */
  var overlay = $('#overlay'), current = null;
  function openDrawer(name) {
    var d = $('#drawer-' + name);
    if (!d) return;
    closeDrawer();
    d.classList.add('open');
    d.setAttribute('aria-hidden', 'false');
    overlay.hidden = false;
    doc.body.classList.add('lock');
    current = d;
    var c = $('[data-close]', d);
    if (c) c.focus();
  }
  function closeDrawer() {
    if (!current) return;
    current.classList.remove('open');
    current.setAttribute('aria-hidden', 'true');
    overlay.hidden = true;
    doc.body.classList.remove('lock');
    current = null;
    if (step === 'done') { step = 'list'; setStep('list'); }
  }
  doc.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeDrawer(); });
  overlay.addEventListener('click', closeDrawer);

  /* ---------- keranjang ---------- */
  function count() { return Object.keys(cart).reduce(function (a, k) { return a + cart[k].qty; }, 0); }
  function total() { return Object.keys(cart).reduce(function (a, k) { return a + cart[k].qty * cart[k].harga; }, 0); }

  function setStep(s) {
    step = s;
    var empty = Object.keys(cart).length === 0;
    $('#cart-view').hidden = s !== 'list';
    $('#co-form').hidden = s !== 'form';
    $('#co-done').hidden = s !== 'done';
    $('#cart-foot').hidden = s !== 'list' || empty;
  }

  function thumb(i) {
    return i.foto ? '<img src="' + esc(i.foto) + '" alt="">' : esc((i.nama || '?').charAt(0).toUpperCase());
  }

  function renderCart() {
    var ids = Object.keys(cart);
    $('#cart-list').innerHTML = ids.map(function (id) {
      var i = cart[id];
      return '<li class="ci"><span class="ci-thumb" aria-hidden="true">' + thumb(i) + '</span>' +
        '<div><strong>' + esc(i.nama) + '</strong><small>' + esc(i.ukuran) + '</small><b>' + rp(i.harga * i.qty) + '</b></div>' +
        '<div class="qty"><button type="button" data-act="minus" data-id="' + id + '" aria-label="Kurangi">−</button>' +
        '<span>' + i.qty + '</span>' +
        '<button type="button" data-act="plus" data-id="' + id + '" aria-label="Tambah">+</button></div></li>';
    }).join('');
    $('#cart-empty').hidden = ids.length > 0;
    $('#cart-total').textContent = rp(total());
    $('#co-total').textContent = rp(total());
    $$('[data-cart-count]').forEach(function (el) { el.textContent = count(); el.hidden = count() === 0; });
    if (step !== 'done') setStep(step === 'form' && ids.length ? 'form' : 'list');
  }

  $('#cart-list').addEventListener('click', function (e) {
    var b = e.target.closest('[data-act]');
    if (!b || !cart[b.dataset.id]) return;
    cart[b.dataset.id].qty += b.dataset.act === 'plus' ? 1 : -1;
    if (cart[b.dataset.id].qty < 1) delete cart[b.dataset.id];
    save('rm_cart', cart);
    renderCart();
  });

  $('#btn-checkout').addEventListener('click', function () { setStep('form'); $('#co-nama').focus(); });
  $('#co-back').addEventListener('click', function () { setStep('list'); });

  $('#co-form').addEventListener('submit', function (e) {
    e.preventDefault();
    var form = e.target, btn = $('button[type=submit]', form), err = $('#co-err'), fd = new FormData(form);
    err.textContent = '';
    btn.disabled = true;
    var body = {
      nama: fd.get('nama'), wa: fd.get('wa'), kota: fd.get('kota'),
      alamat: fd.get('alamat'), catatan: fd.get('catatan'),
      items: Object.keys(cart).map(function (id) { return { id: parseInt(id, 10), qty: cart[id].qty }; })
    };
    fetch(doc.body.dataset.pesananUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json', 'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name=csrf-token]').content
      },
      body: JSON.stringify(body)
    }).then(function (r) {
      return r.json().then(function (d) { return { ok: r.ok, d: d }; });
    }).then(function (res) {
      btn.disabled = false;
      if (!res.ok) {
        err.textContent = res.d.errors ? Object.keys(res.d.errors).map(function (k) { return res.d.errors[k][0]; })[0]
                                       : (res.d.message || 'Pesanan belum terkirim. Coba lagi.');
        return;
      }
      $('#co-kode').textContent = res.d.kode;
      $('#co-total2').textContent = rp(res.d.total);
      $('#co-wa').href = res.d.wa;
      cart = {}; save('rm_cart', cart);
      form.reset();
      step = 'done';
      renderCart();
      setStep('done');
    }).catch(function () {
      btn.disabled = false;
      err.textContent = 'Koneksi bermasalah. Coba lagi.';
    });
  });

  /* ---------- resep tersimpan ---------- */
  function renderFav() {
    var slugs = Object.keys(fav);
    $('#fav-list').innerHTML = slugs.map(function (s) {
      return '<li class="ci"><span class="ci-thumb" aria-hidden="true">♥</span>' +
        '<div><a href="' + esc(fav[s].url) + '">' + esc(fav[s].nama) + '</a></div>' +
        '<div class="qty"><button type="button" data-unfav="' + esc(s) + '" aria-label="Hapus ' + esc(fav[s].nama) + '">×</button></div></li>';
    }).join('');
    $('#fav-empty').hidden = slugs.length > 0;
    $$('[data-fav-count]').forEach(function (el) { el.textContent = slugs.length; el.hidden = slugs.length === 0; });
    $$('[data-fav]').forEach(function (b) {
      var on = !!fav[b.dataset.slug];
      b.classList.toggle('on', on);
      b.setAttribute('aria-pressed', on ? 'true' : 'false');
      if (b.classList.contains('savebtn')) b.textContent = on ? 'Resep tersimpan' : 'Simpan resep';
    });
  }
  $('#fav-list').addEventListener('click', function (e) {
    var b = e.target.closest('[data-unfav]');
    if (!b) return;
    delete fav[b.dataset.unfav];
    save('rm_fav', fav);
    renderFav();
  });

  /* ---------- klik global ---------- */
  doc.addEventListener('click', function (e) {
    var t = e.target;
    var o = t.closest('[data-open]');
    if (o) { openDrawer(o.dataset.open); return; }
    if (t.closest('[data-close]')) { closeDrawer(); return; }

    var f = t.closest('[data-fav]');
    if (f) {
      var s = f.dataset.slug;
      if (fav[s]) delete fav[s]; else fav[s] = { nama: f.dataset.nama, url: f.dataset.url };
      save('rm_fav', fav);
      renderFav();
      return;
    }

    var a = t.closest('[data-add]');
    if (a) {
      var id = a.dataset.id;
      if (cart[id]) cart[id].qty += 1;
      else cart[id] = { nama: a.dataset.nama, harga: parseInt(a.dataset.harga, 10), ukuran: a.dataset.ukuran, foto: a.dataset.foto, qty: 1 };
      save('rm_cart', cart);
      step = 'list';
      renderCart();
      openDrawer('cart');
    }
  });

  /* ---------- tab wilayah ---------- */
  $$('.wil').forEach(function (wil) {
    var btns = $$('[role=tab]', wil), panels = $$('.panel', wil);
    btns.forEach(function (b, i) {
      b.addEventListener('click', function () {
        btns.forEach(function (x, j) { x.setAttribute('aria-selected', j === i ? 'true' : 'false'); });
        panels.forEach(function (p, j) { p.hidden = j !== i; });
      });
    });
  });

  renderCart();
  renderFav();
})();
