import './style.css';

const root = document.documentElement;
const themeButton = document.querySelector('[data-theme-toggle]');

function updateThemeLabel() {
  const isDark = root.dataset.theme === 'dark';
  themeButton.setAttribute('aria-label', isDark ? 'Ativar tema claro' : 'Ativar tema escuro');
}

themeButton.addEventListener('click', () => {
  root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
  localStorage.setItem('theme', root.dataset.theme);
  updateThemeLabel();
  drawStars(0, true);
});
updateThemeLabel();

const starCanvas = document.querySelector('#star-background');
const starContext = starCanvas.getContext('2d', { alpha: false });
const systemTheme = matchMedia('(prefers-color-scheme: dark)');
const reducedMotion = matchMedia('(prefers-reduced-motion: reduce)');
let stars = [];
let starFrame;
let lastStarTime = 0;
let canvasWidth = 0;
let canvasHeight = 0;

function isDarkTheme() {
  return root.dataset.theme === 'dark';
}

function createStars() {
  const amount = Math.min(180, Math.max(70, Math.round((canvasWidth * canvasHeight) / 9000)));
  const maxRadius = Math.hypot(canvasWidth, canvasHeight) * .58;
  stars = Array.from({ length: amount }, (_, index) => ({
    radius: Math.sqrt(Math.random()) * maxRadius,
    angle: Math.random() * Math.PI * 2,
    speed: (.000018 + Math.random() * .000035) * (index % 3 === 0 ? -1 : 1),
    size: .45 + Math.random() * 1.45,
    alpha: .2 + Math.random() * .65,
    pulse: Math.random() * Math.PI * 2,
    warm: Math.random() > .82,
  }));
}

function resizeStarCanvas() {
  const ratio = Math.min(devicePixelRatio || 1, 2);
  canvasWidth = innerWidth;
  canvasHeight = innerHeight;
  starCanvas.width = Math.round(canvasWidth * ratio);
  starCanvas.height = Math.round(canvasHeight * ratio);
  starCanvas.style.width = `${canvasWidth}px`;
  starCanvas.style.height = `${canvasHeight}px`;
  starContext.setTransform(ratio, 0, 0, ratio, 0, 0);
  createStars();
  drawStars(0, true);
}

function drawStars(timestamp, singleFrame = false) {
  const dark = isDarkTheme();
  const elapsed = Math.min(40, timestamp - lastStarTime || 16);
  lastStarTime = timestamp;
  const centerX = canvasWidth / 2;
  const centerY = canvasHeight / 2;

  starContext.fillStyle = dark ? '#070914' : '#eef3fa';
  starContext.fillRect(0, 0, canvasWidth, canvasHeight);

  const glow = starContext.createRadialGradient(centerX, centerY, 0, centerX, centerY, Math.max(canvasWidth, canvasHeight) * .72);
  glow.addColorStop(0, dark ? 'rgba(93, 76, 180, .16)' : 'rgba(118, 153, 210, .15)');
  glow.addColorStop(.5, dark ? 'rgba(32, 72, 120, .07)' : 'rgba(255, 196, 100, .07)');
  glow.addColorStop(1, 'rgba(0, 0, 0, 0)');
  starContext.fillStyle = glow;
  starContext.fillRect(0, 0, canvasWidth, canvasHeight);

  stars.forEach((star) => {
    if (!singleFrame && !reducedMotion.matches) star.angle += star.speed * elapsed;
    const x = centerX + Math.cos(star.angle) * star.radius;
    const y = centerY + Math.sin(star.angle) * star.radius * .72;
    if (x < -5 || x > canvasWidth + 5 || y < -5 || y > canvasHeight + 5) return;
    const pulse = reducedMotion.matches ? 1 : .72 + Math.sin(timestamp * .0015 + star.pulse) * .28;
    starContext.globalAlpha = star.alpha * pulse;
    starContext.fillStyle = dark ? (star.warm ? '#d8c5ff' : '#c8e6ff') : (star.warm ? '#a66b16' : '#526d91');
    starContext.beginPath();
    starContext.arc(x, y, star.size, 0, Math.PI * 2);
    starContext.fill();
    if (star.size > 1.45) {
      starContext.globalAlpha = star.alpha * .12;
      starContext.beginPath();
      starContext.arc(x, y, star.size * 4.2, 0, Math.PI * 2);
      starContext.fill();
    }
  });
  starContext.globalAlpha = 1;
  if (!singleFrame && !reducedMotion.matches) starFrame = requestAnimationFrame(drawStars);
}

function restartStars() {
  cancelAnimationFrame(starFrame);
  lastStarTime = 0;
  if (reducedMotion.matches) drawStars(0, true);
  else starFrame = requestAnimationFrame(drawStars);
}

addEventListener('resize', resizeStarCanvas, { passive: true });
systemTheme.addEventListener('change', () => {
  if (!localStorage.getItem('theme')) {
    root.dataset.theme = systemTheme.matches ? 'dark' : 'light';
    updateThemeLabel();
  }
  drawStars(0, true);
});
reducedMotion.addEventListener('change', restartStars);
resizeStarCanvas();
restartStars();

const header = document.querySelector('[data-header]');
const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 24);
addEventListener('scroll', onScroll, { passive: true });
onScroll();

const copyButton = document.querySelector('[data-copy-email]');
copyButton.addEventListener('click', async () => {
  const original = copyButton.textContent;
  try {
    await navigator.clipboard.writeText(copyButton.dataset.copyEmail);
    copyButton.textContent = 'E-mail copiado ✓';
  } catch {
    window.location.href = `mailto:${copyButton.dataset.copyEmail}`;
  }
  setTimeout(() => { copyButton.textContent = original; }, 2200);
});

document.querySelector('[data-year]').textContent = new Date().getFullYear();

const skillItems = [
  { title: 'Backend & APIs', description: 'PHP, Laravel, Java e construção de APIs REST.', tag: 'Servidor' },
  { title: 'Bancos de dados', description: 'MySQL, PostgreSQL e modelagem de dados.', tag: 'Dados' },
  { title: 'Frontend', description: 'HTML semântico, CSS, JavaScript e Tailwind CSS.', tag: 'Web' },
  { title: 'IA & visão', description: 'Python, OpenCV, MediaPipe, NumPy e Machine Learning.', tag: 'Inteligência' },
  { title: 'DevOps & cloud', description: 'Docker, Firebase Hosting, Linux e automação.', tag: 'Entrega' },
  { title: 'Qualidade', description: 'Git, GitHub, PHPUnit e testes automatizados.', tag: 'Engenharia' },
];

const carousel = document.querySelector('[data-skill-carousel]');
const skillTrack = carousel.querySelector('[data-skill-track]');
const dotsContainer = carousel.querySelector('[data-skill-dots]');
const currentCounter = carousel.querySelector('[data-skill-current]');
carousel.querySelector('[data-skill-total]').textContent = String(skillItems.length).padStart(2, '0');

let activeSkill = 0;
let skillTimer;
let carouselPaused = false;
let skillDragPointer = null;
let skillDragStart = 0;
let skillDragDistance = 0;
let skillWasDragged = false;
let suppressSkillClick = false;

skillItems.forEach((item, index) => {
  const card = document.createElement('button');
  card.type = 'button';
  card.className = 'skill-card';
  card.dataset.skillIndex = index;
  card.setAttribute('role', 'option');
  card.setAttribute('aria-label', `${item.title}: ${item.description}`);
  card.innerHTML = `<span class="skill-tag">${item.tag}</span><span class="skill-card-copy"><strong>${item.title}</strong><small>${item.description}</small></span>`;
  card.addEventListener('click', () => {
    if (!suppressSkillClick) selectSkill(index);
  });
  skillTrack.append(card);

  const dot = document.createElement('button');
  dot.type = 'button';
  dot.className = 'skill-dot';
  dot.dataset.skillDot = index;
  dot.setAttribute('role', 'tab');
  dot.setAttribute('aria-label', `Ir para ${item.title}`);
  dot.addEventListener('click', () => selectSkill(index));
  dotsContainer.append(dot);
});

function wrappedOffset(index) {
  let offset = index - activeSkill;
  const half = Math.floor(skillItems.length / 2);
  if (offset > half) offset -= skillItems.length;
  if (offset < -half) offset += skillItems.length;
  return offset;
}

function renderSkills() {
  const compact = carousel.clientWidth < 600;
  const radiusX = compact ? Math.min(128, carousel.clientWidth * 0.34) : Math.min(290, carousel.clientWidth * 0.38);
  const radiusY = compact ? 88 : 112;

  carousel.querySelectorAll('[data-skill-index]').forEach((card) => {
    const index = Number(card.dataset.skillIndex);
    const offset = wrappedOffset(index);
    const distance = Math.abs(offset);
    const angle = (offset / 5) * Math.PI;
    const x = Math.sin(angle) * radiusX;
    const y = -Math.cos(angle) * radiusY;
    const scale = Math.max(.68, 1 - distance * .1);
    const opacity = Math.max(.28, 1 - distance * .22);
    card.style.setProperty('--skill-x', `${x}px`);
    card.style.setProperty('--skill-y', `${y}px`);
    card.style.setProperty('--skill-scale', scale);
    card.style.zIndex = String(10 - distance);
    card.style.opacity = opacity;
    card.classList.toggle('active', index === activeSkill);
    card.setAttribute('aria-selected', String(index === activeSkill));
    card.tabIndex = index === activeSkill ? 0 : -1;
  });

  carousel.querySelectorAll('[data-skill-dot]').forEach((dot) => {
    const selected = Number(dot.dataset.skillDot) === activeSkill;
    dot.classList.toggle('active', selected);
    dot.setAttribute('aria-selected', String(selected));
    dot.tabIndex = selected ? 0 : -1;
  });
  currentCounter.textContent = String(activeSkill + 1).padStart(2, '0');
}

function selectSkill(index) {
  activeSkill = (index + skillItems.length) % skillItems.length;
  renderSkills();
  restartSkillTimer();
}

function restartSkillTimer() {
  clearInterval(skillTimer);
  if (!carouselPaused && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
    skillTimer = setInterval(() => selectSkill(activeSkill + 1), 4000);
  }
}

carousel.querySelector('[data-skill-prev]').addEventListener('click', () => selectSkill(activeSkill - 1));
carousel.querySelector('[data-skill-next]').addEventListener('click', () => selectSkill(activeSkill + 1));
carousel.addEventListener('keydown', (event) => {
  if (event.key === 'ArrowLeft') { event.preventDefault(); selectSkill(activeSkill - 1); }
  if (event.key === 'ArrowRight') { event.preventDefault(); selectSkill(activeSkill + 1); }
});
carousel.addEventListener('pointerdown', (event) => {
  if (event.button !== 0 || event.target.closest('.skill-controls')) return;
  skillDragPointer = event.pointerId;
  skillDragStart = event.clientX;
  skillDragDistance = 0;
  skillWasDragged = false;
  carouselPaused = true;
  restartSkillTimer();
  carousel.setPointerCapture(event.pointerId);
});
carousel.addEventListener('pointermove', (event) => {
  if (event.pointerId !== skillDragPointer) return;
  skillDragDistance = event.clientX - skillDragStart;
  if (Math.abs(skillDragDistance) > 5) {
    skillWasDragged = true;
    carousel.classList.add('dragging');
    const visualOffset = Math.max(-90, Math.min(90, skillDragDistance * .42));
    skillTrack.style.transform = `translateX(${visualOffset}px)`;
  }
});

function finishSkillDrag(event, cancelled = false) {
  if (event.pointerId !== skillDragPointer) return;
  if (carousel.hasPointerCapture(event.pointerId)) carousel.releasePointerCapture(event.pointerId);
  skillTrack.style.transform = '';
  carousel.classList.remove('dragging');
  if (skillWasDragged) {
    suppressSkillClick = true;
    if (!cancelled && Math.abs(skillDragDistance) >= 42) {
      selectSkill(activeSkill + (skillDragDistance < 0 ? 1 : -1));
    }
    setTimeout(() => { suppressSkillClick = false; }, 400);
  }
  skillDragPointer = null;
  skillWasDragged = false;
  carouselPaused = carousel.matches(':hover') || carousel.contains(document.activeElement);
  restartSkillTimer();
}

carousel.addEventListener('pointerup', (event) => finishSkillDrag(event));
carousel.addEventListener('pointercancel', (event) => finishSkillDrag(event, true));
carousel.addEventListener('mouseenter', () => { carouselPaused = true; restartSkillTimer(); });
carousel.addEventListener('mouseleave', () => { carouselPaused = false; restartSkillTimer(); });
carousel.addEventListener('focusin', () => { carouselPaused = true; restartSkillTimer(); });
carousel.addEventListener('focusout', (event) => {
  if (!carousel.contains(event.relatedTarget)) { carouselPaused = false; restartSkillTimer(); }
});
addEventListener('resize', renderSkills, { passive: true });
renderSkills();
restartSkillTimer();

const searchModal = document.querySelector('[data-search-modal]');
const searchInput = document.querySelector('[data-search-input]');
const searchResults = document.querySelector('[data-search-results]');
const searchEmpty = document.querySelector('[data-search-empty]');
const searchOpenButton = document.querySelector('[data-search-open]');
let searchSelection = 0;
let visibleSearchEntries = [];
let searchOpener = null;

const searchEntries = [
  { title: 'Início', detail: 'Apresentação profissional', target: '#inicio', code: '00' },
  { title: 'Sobre', detail: 'Formação, atuação e objetivos', target: '#sobre', code: '01' },
  { title: 'Projetos', detail: 'Trabalhos recentes no GitHub', target: '#projetos', code: '02' },
  { title: 'Sistema de Estoque', detail: 'JavaScript, Firebase e Firestore', target: '#projeto-estoque', code: 'P1' },
  { title: 'Sistema de Manutenção', detail: 'Demandas, unidades e relatórios', target: '#projeto-manutencao', code: 'P2' },
  { title: 'Jogo do Folclore', detail: 'Godot, GDScript e game design', target: '#projeto-folclore', code: 'P3' },
  { title: 'Competências', detail: 'Carrossel de habilidades técnicas', target: '#competencias', code: '03' },
  ...skillItems.map((skill, index) => ({
    title: skill.title,
    detail: skill.description,
    target: '#competencias',
    skillIndex: index,
    code: `H${index + 1}`,
  })),
  { title: 'Contato', detail: 'E-mail, GitHub e LinkedIn', target: '#contato', code: '04' },
];

function normalizeSearchText(value) {
  return value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
}

function updateSearchSelection(index) {
  const buttons = [...searchResults.querySelectorAll('.search-result')];
  if (!buttons.length) return;
  searchSelection = (index + buttons.length) % buttons.length;
  buttons.forEach((button, buttonIndex) => {
    const selected = buttonIndex === searchSelection;
    button.classList.toggle('active', selected);
    button.setAttribute('aria-selected', String(selected));
    button.tabIndex = selected ? 0 : -1;
  });
  searchInput.setAttribute('aria-activedescendant', buttons[searchSelection].id);
  buttons[searchSelection].scrollIntoView({ block: 'nearest' });
}

function closeSearch({ restoreFocus = true } = {}) {
  if (searchModal.hidden) return;
  searchModal.hidden = true;
  document.body.classList.remove('search-open');
  searchInput.value = '';
  searchInput.removeAttribute('aria-activedescendant');
  if (restoreFocus && searchOpener) searchOpener.focus();
}

function openSearch() {
  searchOpener = document.activeElement;
  searchModal.hidden = false;
  document.body.classList.add('search-open');
  renderSearchResults('');
  requestAnimationFrame(() => searchInput.focus());
}

function navigateToSearchEntry(entry) {
  closeSearch({ restoreFocus: false });
  if (Number.isInteger(entry.skillIndex)) selectSkill(entry.skillIndex);
  const target = document.querySelector(entry.target);
  if (!target) return;
  target.scrollIntoView({ behavior: reducedMotion.matches ? 'auto' : 'smooth', block: 'start' });
  target.tabIndex = -1;
  target.focus({ preventScroll: true });
  history.replaceState(null, '', entry.target);
}

function renderSearchResults(query) {
  const terms = normalizeSearchText(query).split(/\s+/).filter(Boolean);
  visibleSearchEntries = searchEntries.filter((entry) => {
    const content = normalizeSearchText(`${entry.title} ${entry.detail}`);
    return terms.every((term) => content.includes(term));
  });
  searchResults.replaceChildren();
  searchEmpty.hidden = visibleSearchEntries.length > 0;
  visibleSearchEntries.forEach((entry, index) => {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'search-result';
    button.id = `search-result-${index}`;
    button.setAttribute('role', 'option');
    button.innerHTML = `<span class="search-result-icon">${entry.code}</span><span><strong>${entry.title}</strong><small>${entry.detail}</small></span><kbd>ENTER</kbd>`;
    button.addEventListener('mouseenter', () => updateSearchSelection(index));
    button.addEventListener('focus', () => updateSearchSelection(index));
    button.addEventListener('click', () => navigateToSearchEntry(entry));
    searchResults.append(button);
  });
  searchSelection = 0;
  if (visibleSearchEntries.length) updateSearchSelection(0);
  else searchInput.removeAttribute('aria-activedescendant');
}

searchOpenButton.addEventListener('click', openSearch);
document.querySelectorAll('[data-search-close]').forEach((button) => button.addEventListener('click', () => closeSearch()));
searchInput.addEventListener('input', () => renderSearchResults(searchInput.value));
searchInput.addEventListener('keydown', (event) => {
  if (event.key === 'ArrowDown') { event.preventDefault(); updateSearchSelection(searchSelection + 1); }
  if (event.key === 'ArrowUp') { event.preventDefault(); updateSearchSelection(searchSelection - 1); }
  if (event.key === 'Enter' && visibleSearchEntries[searchSelection]) {
    event.preventDefault();
    navigateToSearchEntry(visibleSearchEntries[searchSelection]);
  }
});

searchModal.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') { event.preventDefault(); closeSearch(); return; }
  if (event.key !== 'Tab') return;
  const focusable = [...searchModal.querySelectorAll('button:not([tabindex="-1"]), input')].filter((element) => !element.hidden);
  if (!focusable.length) return;
  const first = focusable[0];
  const last = focusable[focusable.length - 1];
  if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
  else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
});

addEventListener('keydown', (event) => {
  const tag = document.activeElement?.tagName;
  const editing = tag === 'INPUT' || tag === 'TEXTAREA' || document.activeElement?.isContentEditable;
  if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
    event.preventDefault();
    searchModal.hidden ? openSearch() : closeSearch();
  } else if (event.key === '/' && !editing && searchModal.hidden) {
    event.preventDefault();
    openSearch();
  }
});

if ('IntersectionObserver' in window && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));
} else {
  document.querySelectorAll('.reveal').forEach((element) => element.classList.add('visible'));
}
