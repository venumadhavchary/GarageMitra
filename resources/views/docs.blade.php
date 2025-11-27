<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GarageMitra - Design System & Style Guide</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        html { scroll-padding-top: 80px; }
        
        /* Side Menu Styles */
        .docs-layout {
            display: flex;
            gap: 2rem;
        }

        .docs-sidebar {
            position: sticky;
            top: 80px;
            width: 240px;
            height: calc(100vh - 100px);
            overflow-y: auto;
            flex-shrink: 0;
            padding: 1rem 0;
        }

        .docs-sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .docs-sidebar::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 4px;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            padding: 0.75rem 1rem;
            margin: 0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav a {
            display: block;
            padding: 0.5rem 1rem;
            color: var(--gray-600);
            text-decoration: none;
            font-size: 0.875rem;
            border-left: 2px solid transparent;
            transition: all 0.2s;
        }

        .sidebar-nav a:hover {
            color: var(--primary);
            background: var(--gray-50);
        }

        .sidebar-nav a.active {
            color: var(--primary);
            border-left-color: var(--primary);
            background: var(--primary-light);
            font-weight: 500;
        }

        .docs-content {
            flex: 1;
            min-width: 0;
        }

        /* Code Block with Copy Button */
        .docs-code {
            position: relative;
        }

        .copy-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            background: var(--gray-700);
            color: var(--gray-300);
            border: 1px solid var(--gray-600);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            z-index: 10;
        }

        .copy-btn:hover {
            background: var(--gray-600);
            color: white;
        }

        .copy-btn.copied {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        /* Multiple Image Upload Styles - Square + Button */
        .image-upload-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-start;
        }

        .image-upload-box {
            position: relative;
            width: 100px;
            height: 100px;
            border: 2px dashed var(--gray-300);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: var(--gray-50);
            flex-shrink: 0;
        }

        .image-upload-box:hover,
        .image-upload-box.dragover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .image-upload-box .plus-icon {
            font-size: 2.5rem;
            color: var(--gray-400);
            font-weight: 300;
            line-height: 1;
            transition: all 0.2s ease;
        }

        .image-upload-box:hover .plus-icon {
            color: var(--primary);
            transform: scale(1.1);
        }

        .image-upload-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .image-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview-item .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--danger);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.2s;
            line-height: 1;
        }

        .image-preview-item:hover .remove-btn { 
            opacity: 1; 
        }

        /* Input Validation States */
        .form-control.is-valid {
            border-color: var(--success);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
            padding-right: 2.5rem;
        }

        .form-control.is-valid:focus {
            border-color: var(--success);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.15);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
            padding-right: 2.5rem;
        }

        .form-control.is-invalid:focus {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .text-success {
            color: var(--success) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .form-text.text-success,
        .form-text.text-danger {
            font-weight: 500;
        }

        /* Responsive sidebar */
        @media (max-width: 992px) {
            .docs-sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- ==================== NAVBAR ==================== -->
<nav class="navbar">
    <a href="#" class="navbar-brand">
        🔧 GarageMitra
    </a>
    
    <button class="navbar-toggle" onclick="toggleNav()">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
    <ul class="navbar-nav" id="navbarNav">
        <li class="nav-item">
            <a href="#colors" class="nav-link active">Colors</a>
        </li>
        <li class="nav-item">
            <a href="#typography" class="nav-link">Typography</a>
        </li>
        <li class="nav-item">
            <a href="#buttons" class="nav-link">Buttons</a>
        </li>
        <li class="nav-item">
            <a href="#forms" class="nav-link">Forms</a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link">Components ▾</a>
            <div class="dropdown-menu">
                <a href="#cards" class="dropdown-item">Cards</a>
                <a href="#alerts" class="dropdown-item">Alerts</a>
                <a href="#badges" class="dropdown-item">Badges</a>
                <a href="#tables" class="dropdown-item">Tables</a>
                <div class="dropdown-divider"></div>
                <a href="#modals" class="dropdown-item">Modals</a>
            </div>
        </li>
    </ul>
    
    <div class="navbar-actions">
        <button class="btn btn-success" onclick="openFormModal()">➕ New Job Card</button>
        <button class="btn btn-ghost btn-icon">🔔</button>
        <button class="btn btn-primary">Dashboard</button>
    </div>
</nav>

<div class="container" style="padding: 2rem 1rem;">

    <!-- Page Header -->
    <div class="text-center mb-8">
        <h1>🔧 GarageMitra Design System</h1>
        <p class="text-muted">A complete style guide with all components and code examples</p>
    </div>

    <div class="docs-layout">
        <!-- Side Menu -->
        <aside class="docs-sidebar">
            <p class="sidebar-title">Getting Started</p>
            <ul class="sidebar-nav">
                <li><a href="#colors" class="active">🎨 Colors</a></li>
                <li><a href="#typography">📝 Typography</a></li>
            </ul>
            
            <p class="sidebar-title">Components</p>
            <ul class="sidebar-nav">
                <li><a href="#buttons">🔘 Buttons</a></li>
                <li><a href="#forms">📋 Forms</a></li>
                <li><a href="#cards">🃏 Cards</a></li>
                <li><a href="#alerts">⚠️ Alerts</a></li>
                <li><a href="#badges">🏷️ Badges</a></li>
                <li><a href="#tables">📊 Tables</a></li>
                <li><a href="#modals">🪟 Modals</a></li>
            </ul>
            
            <p class="sidebar-title">Navigation</p>
            <ul class="sidebar-nav">
                <li><a href="#navbar-docs">🧭 Navbar</a></li>
            </ul>
            
            <p class="sidebar-title">Helpers</p>
            <ul class="sidebar-nav">
                <li><a href="#utilities">🛠️ Utilities</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="docs-content">
    <!-- ==================== COLORS ==================== -->
    <section id="colors" class="docs-section">
        <h2 class="docs-section-title">🎨 Colors</h2>
        
        <h4>Primary & Secondary</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-4">
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #2563eb;"></div>
                    <div>
                        <strong>Primary</strong><br>
                        <code>#2563eb</code>
                    </div>
                </div>
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #64748b;"></div>
                    <div>
                        <strong>Secondary</strong><br>
                        <code>#64748b</code>
                    </div>
                </div>
            </div>
        </div>
        
        <h4>Status Colors</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-4">
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #16a34a;"></div>
                    <div><strong>Success</strong><br><code>#16a34a</code></div>
                </div>
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #dc2626;"></div>
                    <div><strong>Danger</strong><br><code>#dc2626</code></div>
                </div>
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #f59e0b;"></div>
                    <div><strong>Warning</strong><br><code>#f59e0b</code></div>
                </div>
                <div class="color-swatch">
                    <div class="color-box" style="background-color: #0891b2;"></div>
                    <div><strong>Info</strong><br><code>#0891b2</code></div>
                </div>
            </div>
        </div>

        <h4>Usage</h4>
        <div class="docs-code">
            <pre><code>&lt;!-- Use CSS variables --&gt;
.my-element {
    color: var(--primary);
    background-color: var(--success-light);
    border-color: var(--danger);
}

&lt;!-- Or utility classes --&gt;
&lt;p class="text-primary"&gt;Primary text&lt;/p&gt;
&lt;p class="text-success"&gt;Success text&lt;/p&gt;
&lt;div class="bg-light"&gt;Light background&lt;/div&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== TYPOGRAPHY ==================== -->
    <section id="typography" class="docs-section">
        <h2 class="docs-section-title">📝 Typography</h2>
        
        <div class="docs-preview">
            <h1>Heading 1 - 2.25rem</h1>
            <h2>Heading 2 - 1.875rem</h2>
            <h3>Heading 3 - 1.5rem</h3>
            <h4>Heading 4 - 1.25rem</h4>
            <h5>Heading 5 - 1.125rem</h5>
            <h6>Heading 6 - 1rem</h6>
            <p>This is a paragraph with <a href="#">a link</a> and <code>inline code</code>.</p>
        </div>
        
        <h4>Usage</h4>
        <div class="docs-code">
            <pre><code>&lt;h1&gt;Heading 1&lt;/h1&gt;
&lt;h2&gt;Heading 2&lt;/h2&gt;
&lt;h3&gt;Heading 3&lt;/h3&gt;
&lt;h4&gt;Heading 4&lt;/h4&gt;
&lt;h5&gt;Heading 5&lt;/h5&gt;
&lt;h6&gt;Heading 6&lt;/h6&gt;

&lt;p&gt;Paragraph text with &lt;a href="#"&gt;a link&lt;/a&gt;&lt;/p&gt;
&lt;p&gt;Use &lt;code&gt;code&lt;/code&gt; for inline code&lt;/p&gt;

&lt;!-- Text utilities --&gt;
&lt;p class="text-center"&gt;Centered text&lt;/p&gt;
&lt;p class="text-muted"&gt;Muted text&lt;/p&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== BUTTONS ==================== -->
    <section id="buttons" class="docs-section">
        <h2 class="docs-section-title">🔘 Buttons</h2>
        
        <h4>Solid Buttons</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3">
                <button class="btn btn-primary">Primary</button>
                <button class="btn btn-secondary">Secondary</button>
                <button class="btn btn-success">Success</button>
                <button class="btn btn-danger">Danger</button>
                <button class="btn btn-warning">Warning</button>
                <button class="btn btn-info">Info</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-primary"&gt;Primary&lt;/button&gt;
&lt;button class="btn btn-secondary"&gt;Secondary&lt;/button&gt;
&lt;button class="btn btn-success"&gt;Success&lt;/button&gt;
&lt;button class="btn btn-danger"&gt;Danger&lt;/button&gt;
&lt;button class="btn btn-warning"&gt;Warning&lt;/button&gt;
&lt;button class="btn btn-info"&gt;Info&lt;/button&gt;</code></pre>
        </div>

        <h4>Outline Buttons</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3">
                <button class="btn btn-outline-primary">Primary</button>
                <button class="btn btn-outline-secondary">Secondary</button>
                <button class="btn btn-outline-danger">Danger</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-outline-primary"&gt;Primary&lt;/button&gt;
&lt;button class="btn btn-outline-secondary"&gt;Secondary&lt;/button&gt;
&lt;button class="btn btn-outline-danger"&gt;Danger&lt;/button&gt;</code></pre>
        </div>

        <h4>Ghost & Link Buttons</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3 align-items-center">
                <button class="btn btn-ghost">Ghost Button</button>
                <button class="btn btn-link">Link Button</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-ghost"&gt;Ghost Button&lt;/button&gt;
&lt;button class="btn btn-link"&gt;Link Button&lt;/button&gt;</code></pre>
        </div>

        <h4>Button Sizes</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3 align-items-center">
                <button class="btn btn-primary btn-sm">Small</button>
                <button class="btn btn-primary">Default</button>
                <button class="btn btn-primary btn-lg">Large</button>
                <button class="btn btn-primary btn-xl">Extra Large</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-primary btn-sm"&gt;Small&lt;/button&gt;
&lt;button class="btn btn-primary"&gt;Default&lt;/button&gt;
&lt;button class="btn btn-primary btn-lg"&gt;Large&lt;/button&gt;
&lt;button class="btn btn-primary btn-xl"&gt;Extra Large&lt;/button&gt;</code></pre>
        </div>

        <h4>Block & Disabled Buttons</h4>
        <div class="docs-preview">
            <button class="btn btn-primary btn-block mb-3">Block Button (Full Width)</button>
            <button class="btn btn-primary" disabled>Disabled Button</button>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-primary btn-block"&gt;Block Button&lt;/button&gt;
&lt;button class="btn btn-primary" disabled&gt;Disabled Button&lt;/button&gt;</code></pre>
        </div>

        <h4>Button Group</h4>
        <div class="docs-preview">
            <div class="btn-group">
                <button class="btn btn-primary">Left</button>
                <button class="btn btn-primary">Middle</button>
                <button class="btn btn-primary">Right</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="btn-group"&gt;
    &lt;button class="btn btn-primary"&gt;Left&lt;/button&gt;
    &lt;button class="btn btn-primary"&gt;Middle&lt;/button&gt;
    &lt;button class="btn btn-primary"&gt;Right&lt;/button&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Icon Buttons</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3 align-items-center">
                <button class="btn btn-primary btn-icon btn-sm">✏️</button>
                <button class="btn btn-primary btn-icon">🔍</button>
                <button class="btn btn-primary btn-icon btn-lg">🗑️</button>
                <button class="btn btn-danger btn-icon">❌</button>
                <button class="btn btn-success btn-icon">✓</button>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;button class="btn btn-primary btn-icon btn-sm"&gt;✏️&lt;/button&gt;
&lt;button class="btn btn-primary btn-icon"&gt;🔍&lt;/button&gt;
&lt;button class="btn btn-primary btn-icon btn-lg"&gt;🗑️&lt;/button&gt;
&lt;button class="btn btn-danger btn-icon"&gt;❌&lt;/button&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== FORMS ==================== -->
    <section id="forms" class="docs-section">
        <h2 class="docs-section-title">📋 Forms & Inputs</h2>
        
        <h4>Text Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label class="form-label required">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email">
                <span class="form-text">We'll never share your email.</span>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Name&lt;/label&gt;
    &lt;input type="text" class="form-control" placeholder="Enter your name"&gt;
&lt;/div&gt;

&lt;div class="form-group"&gt;
    &lt;label class="form-label required"&gt;Email&lt;/label&gt;
    &lt;input type="email" class="form-control" placeholder="Enter your email"&gt;
    &lt;span class="form-text"&gt;We'll never share your email.&lt;/span&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Input with Success & Error States</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control is-valid" value="john_doe" placeholder="Enter username">
                <span class="form-text text-success">✓ Username is available!</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Email Address</label>
                <input type="email" class="form-control is-invalid" value="invalid-email" placeholder="Enter email">
                <span class="form-text text-danger">✗ Please enter a valid email address.</span>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control is-valid" value="+1 234-567-8900" placeholder="Enter phone">
                <span class="form-text text-success">✓ Phone number verified successfully.</span>
            </div>
            <div class="form-group">
                <label class="form-label required">Password</label>
                <input type="password" class="form-control is-invalid" placeholder="Enter password">
                <span class="form-text text-danger">✗ Password must be at least 8 characters.</span>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;!-- Success State --&gt;
&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Username&lt;/label&gt;
    &lt;input type="text" class="form-control is-valid" value="john_doe"&gt;
    &lt;span class="form-text text-success"&gt;✓ Username is available!&lt;/span&gt;
&lt;/div&gt;

&lt;!-- Error State --&gt;
&lt;div class="form-group"&gt;
    &lt;label class="form-label required"&gt;Email Address&lt;/label&gt;
    &lt;input type="email" class="form-control is-invalid" value="invalid-email"&gt;
    &lt;span class="form-text text-danger"&gt;✗ Please enter a valid email address.&lt;/span&gt;
&lt;/div&gt;

&lt;!-- Classes: is-valid, is-invalid --&gt;
&lt;!-- Text Classes: text-success, text-danger --&gt;</code></pre>
        </div>

        <h4>Input Sizes</h4>
        <div class="docs-preview">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" placeholder="Small input">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Default input">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" placeholder="Large input">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;input type="text" class="form-control form-control-sm" placeholder="Small"&gt;
&lt;input type="text" class="form-control" placeholder="Default"&gt;
&lt;input type="text" class="form-control form-control-lg" placeholder="Large"&gt;</code></pre>
        </div>

        <h4>Password Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter password">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Password&lt;/label&gt;
    &lt;input type="password" class="form-control" placeholder="Enter password"&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Number Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" placeholder="0" min="0" max="100">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Quantity&lt;/label&gt;
    &lt;input type="number" class="form-control" min="0" max="100"&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Phone Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Phone Number&lt;/label&gt;
    &lt;input type="tel" class="form-control" placeholder="123-456-7890" 
           pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Date & Time Inputs</h4>
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-4">
                <div class="form-group" style="flex: 1; min-width: 200px;">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group" style="flex: 1; min-width: 200px;">
                    <label class="form-label">Time</label>
                    <input type="time" class="form-control">
                </div>
                <div class="form-group" style="flex: 1; min-width: 200px;">
                    <label class="form-label">Date & Time</label>
                    <input type="datetime-local" class="form-control">
                </div>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;input type="date" class="form-control"&gt;
&lt;input type="time" class="form-control"&gt;
&lt;input type="datetime-local" class="form-control"&gt;</code></pre>
        </div>

        <h4>Textarea</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="4" placeholder="Enter description..."></textarea>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Description&lt;/label&gt;
    &lt;textarea class="form-control" rows="4" placeholder="Enter description..."&gt;&lt;/textarea&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Select Dropdown</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Select Mechanic</label>
                <select class="form-control">
                    <option value="">Choose a mechanic...</option>
                    <option value="1">John Smith - Engine Specialist</option>
                    <option value="2">Mike Johnson - Brake Expert</option>
                    <option value="3">Sarah Davis - Electrical</option>
                </select>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Select Mechanic&lt;/label&gt;
    &lt;select class="form-control"&gt;
        &lt;option value=""&gt;Choose a mechanic...&lt;/option&gt;
        &lt;option value="1"&gt;John Smith - Engine Specialist&lt;/option&gt;
        &lt;option value="2"&gt;Mike Johnson - Brake Expert&lt;/option&gt;
        &lt;option value="3"&gt;Sarah Davis - Electrical&lt;/option&gt;
    &lt;/select&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Checkboxes</h4>
        <div class="docs-preview">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check1">
                <label class="form-check-label" for="check1">Default Checkbox</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check2" checked>
                <label class="form-check-label" for="check2">Checked Checkbox</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check3" disabled>
                <label class="form-check-label" for="check3">Disabled Checkbox</label>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-check"&gt;
    &lt;input type="checkbox" class="form-check-input" id="check1"&gt;
    &lt;label class="form-check-label" for="check1"&gt;Default Checkbox&lt;/label&gt;
&lt;/div&gt;

&lt;div class="form-check"&gt;
    &lt;input type="checkbox" class="form-check-input" id="check2" checked&gt;
    &lt;label class="form-check-label" for="check2"&gt;Checked Checkbox&lt;/label&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Radio Buttons</h4>
        <div class="docs-preview">
            <div class="form-check">
                <input type="radio" class="form-check-input" name="status" id="radio1" checked>
                <label class="form-check-label" for="radio1">Pending</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="status" id="radio2">
                <label class="form-check-label" for="radio2">In Progress</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="status" id="radio3">
                <label class="form-check-label" for="radio3">Completed</label>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-check"&gt;
    &lt;input type="radio" class="form-check-input" name="status" id="radio1" checked&gt;
    &lt;label class="form-check-label" for="radio1"&gt;Pending&lt;/label&gt;
&lt;/div&gt;

&lt;div class="form-check"&gt;
    &lt;input type="radio" class="form-check-input" name="status" id="radio2"&gt;
    &lt;label class="form-check-label" for="radio2"&gt;In Progress&lt;/label&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Switch Toggle</h4>
        <div class="docs-preview">
            <label class="form-switch">
                <input type="checkbox">
                <span class="slider"></span>
                <span>Enable notifications</span>
            </label>
            <br><br>
            <label class="form-switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
                <span>Active status</span>
            </label>
        </div>
        <div class="docs-code">
            <pre><code>&lt;label class="form-switch"&gt;
    &lt;input type="checkbox"&gt;
    &lt;span class="slider"&gt;&lt;/span&gt;
    &lt;span&gt;Enable notifications&lt;/span&gt;
&lt;/label&gt;

&lt;label class="form-switch"&gt;
    &lt;input type="checkbox" checked&gt;
    &lt;span class="slider"&gt;&lt;/span&gt;
    &lt;span&gt;Active status&lt;/span&gt;
&lt;/label&gt;</code></pre>
        </div>

        <h4>Range Slider</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Price Range: <span id="rangeValue">50</span></label>
                <input type="range" class="form-range" min="0" max="100" value="50" 
                       oninput="document.getElementById('rangeValue').textContent = this.value">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Price Range: &lt;span id="rangeValue"&gt;50&lt;/span&gt;&lt;/label&gt;
    &lt;input type="range" class="form-range" min="0" max="100" value="50"&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>File Upload</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Upload Document</label>
                <div class="form-file">
                    <input type="file" id="fileInput" accept=".pdf,.doc,.docx">
                    <label class="form-file-label" for="fileInput">
                        📁 Click to upload or drag and drop
                    </label>
                </div>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Upload Document&lt;/label&gt;
    &lt;div class="form-file"&gt;
        &lt;input type="file" id="fileInput" accept=".pdf,.doc,.docx"&gt;
        &lt;label class="form-file-label" for="fileInput"&gt;
            📁 Click to upload or drag and drop
        &lt;/label&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Multiple Image Upload with Preview</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Upload Vehicle Images</label>
                <div class="image-upload-wrapper" id="imageUploadWrapper">
                    <!-- Plus Button -->
                    <div class="image-upload-box" id="imageUploadBox">
                        <input type="file" id="multiImageInput" name="images[]" multiple accept="image/*">
                        <span class="plus-icon">+</span>
                    </div>
                    <!-- Images will be inserted here -->
                </div>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;!-- HTML Structure --&gt;
&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Upload Vehicle Images&lt;/label&gt;
    &lt;div class="image-upload-wrapper" id="imageUploadWrapper"&gt;
        &lt;!-- Plus Button --&gt;
        &lt;div class="image-upload-box" id="imageUploadBox"&gt;
            &lt;input type="file" id="multiImageInput" name="images[]" multiple accept="image/*"&gt;
            &lt;span class="plus-icon"&gt;+&lt;/span&gt;
        &lt;/div&gt;
        &lt;!-- Images will be inserted here dynamically --&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- CSS Styles --&gt;
&lt;style&gt;
.image-upload-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: flex-start;
}

.image-upload-box {
    position: relative;
    width: 100px;
    height: 100px;
    border: 2px dashed var(--gray-300);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    background: var(--gray-50);
    flex-shrink: 0;
}

.image-upload-box:hover {
    border-color: var(--primary);
    background: var(--primary-light);
}

.image-upload-box .plus-icon {
    font-size: 2.5rem;
    color: var(--gray-400);
    font-weight: 300;
    transition: all 0.2s ease;
}

.image-upload-box:hover .plus-icon {
    color: var(--primary);
    transform: scale(1.1);
}

.image-upload-box input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    cursor: pointer;
}

.image-preview-item {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    flex-shrink: 0;
}

.image-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview-item .remove-btn {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--danger);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s;
}

.image-preview-item:hover .remove-btn {
    opacity: 1;
}
&lt;/style&gt;

&lt;!-- JavaScript --&gt;
&lt;script&gt;
const imageInput = document.getElementById('multiImageInput');
const uploadWrapper = document.getElementById('imageUploadWrapper');
const uploadBox = document.getElementById('imageUploadBox');
let selectedFiles = [];

imageInput.addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    
    files.forEach(file =&gt; {
        if (file.type.startsWith('image/')) {
            selectedFiles.push(file);
            const index = selectedFiles.length - 1;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-preview-item';
                div.dataset.index = index;
                div.innerHTML = `
                    &lt;img src="${e.target.result}" alt="Preview"&gt;
                    &lt;button type="button" class="remove-btn" onclick="removeImage(${index})"&gt;×&lt;/button&gt;
                `;
                // Insert before the + button
                uploadWrapper.insertBefore(div, uploadBox);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Clear input for re-selection
    imageInput.value = '';
});

function removeImage(index) {
    selectedFiles[index] = null;
    const item = document.querySelector(`.image-preview-item[data-index="${index}"]`);
    if (item) item.remove();
}
&lt;/script&gt;</code></pre>
        </div>

        <h4>Color Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Vehicle Color</label>
                <input type="color" class="form-control" value="#2563eb" style="width: 80px; height: 40px; padding: 4px;">
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Vehicle Color&lt;/label&gt;
    &lt;input type="color" class="form-control" value="#2563eb"&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Input Groups</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="number" class="form-control" placeholder="0.00">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search mechanics...">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Website</label>
                <div class="input-group">
                    <span class="input-group-text">https://</span>
                    <input type="text" class="form-control" placeholder="example.com">
                    <span class="input-group-text">.com</span>
                </div>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;!-- Price input --&gt;
&lt;div class="input-group"&gt;
    &lt;span class="input-group-text"&gt;₹&lt;/span&gt;
    &lt;input type="number" class="form-control" placeholder="0.00"&gt;
&lt;/div&gt;

&lt;!-- Search input with button --&gt;
&lt;div class="input-group"&gt;
    &lt;input type="text" class="form-control" placeholder="Search..."&gt;
    &lt;button class="btn btn-primary"&gt;Search&lt;/button&gt;
&lt;/div&gt;

&lt;!-- URL input --&gt;
&lt;div class="input-group"&gt;
    &lt;span class="input-group-text"&gt;https://&lt;/span&gt;
    &lt;input type="text" class="form-control" placeholder="example"&gt;
    &lt;span class="input-group-text"&gt;.com&lt;/span&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Validation States</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Valid Input</label>
                <input type="text" class="form-control is-valid" value="John Doe">
                <span class="valid-feedback">Looks good!</span>
            </div>
            <div class="form-group">
                <label class="form-label">Invalid Input</label>
                <input type="email" class="form-control is-invalid" value="invalid-email">
                <span class="invalid-feedback">Please enter a valid email address.</span>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;!-- Valid state --&gt;
&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Valid Input&lt;/label&gt;
    &lt;input type="text" class="form-control is-valid" value="John Doe"&gt;
    &lt;span class="valid-feedback"&gt;Looks good!&lt;/span&gt;
&lt;/div&gt;

&lt;!-- Invalid state --&gt;
&lt;div class="form-group"&gt;
    &lt;label class="form-label"&gt;Invalid Input&lt;/label&gt;
    &lt;input type="email" class="form-control is-invalid" value="invalid-email"&gt;
    &lt;span class="invalid-feedback"&gt;Please enter a valid email.&lt;/span&gt;
&lt;/div&gt;</code></pre>
        </div>

        <h4>Disabled Input</h4>
        <div class="docs-preview">
            <div class="form-group">
                <label class="form-label">Disabled Input</label>
                <input type="text" class="form-control" value="Cannot edit this" disabled>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;input type="text" class="form-control" value="Cannot edit" disabled&gt;</code></pre>
        </div>

        <h4>Complete Form Example</h4>
        <div class="docs-preview">
            <form>
                <div class="d-flex flex-wrap gap-4">
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Customer Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" required>
                    </div>
                    <div class="form-group" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Phone</label>
                        <input type="tel" class="form-control" placeholder="Enter phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Vehicle Number</label>
                    <input type="text" class="form-control" placeholder="e.g., MH12AB1234">
                </div>
                <div class="form-group">
                    <label class="form-label">Assign Mechanic</label>
                    <select class="form-control">
                        <option value="">Select mechanic...</option>
                        <option>John Smith</option>
                        <option>Mike Johnson</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Issue Description</label>
                    <textarea class="form-control" rows="3" placeholder="Describe the issue..."></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="urgent">
                    <label class="form-check-label" for="urgent">Mark as urgent</label>
                </div>
                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary">Create Job Card</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
            </form>
        </div>
        <div class="docs-code">
            <pre><code>&lt;form&gt;
    &lt;div class="form-group"&gt;
        &lt;label class="form-label required"&gt;Customer Name&lt;/label&gt;
        &lt;input type="text" class="form-control" required&gt;
    &lt;/div&gt;
    
    &lt;div class="form-group"&gt;
        &lt;label class="form-label"&gt;Select Mechanic&lt;/label&gt;
        &lt;select class="form-control"&gt;
            &lt;option&gt;Choose...&lt;/option&gt;
        &lt;/select&gt;
    &lt;/div&gt;
    
    &lt;div class="form-group"&gt;
        &lt;label class="form-label"&gt;Description&lt;/label&gt;
        &lt;textarea class="form-control" rows="3"&gt;&lt;/textarea&gt;
    &lt;/div&gt;
    
    &lt;div class="form-check"&gt;
        &lt;input type="checkbox" class="form-check-input" id="urgent"&gt;
        &lt;label class="form-check-label" for="urgent"&gt;Mark as urgent&lt;/label&gt;
    &lt;/div&gt;
    
    &lt;button type="submit" class="btn btn-primary"&gt;Submit&lt;/button&gt;
&lt;/form&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== CARDS ==================== -->
    <section id="cards" class="docs-section">
        <h2 class="docs-section-title">🃏 Cards</h2>
        
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-4">
                <div class="card" style="flex: 1; min-width: 280px;">
                    <div class="card-header">
                        <h5 class="card-title">Job Card #1234</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Customer:</strong> Rahul Sharma</p>
                        <p><strong>Vehicle:</strong> MH12AB1234</p>
                        <p><strong>Issue:</strong> Engine overheating</p>
                        <span class="badge badge-warning">In Progress</span>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm">View Details</button>
                        <button class="btn btn-outline-secondary btn-sm">Edit</button>
                    </div>
                </div>
                
                <div class="card" style="flex: 1; min-width: 280px;">
                    <div class="card-body">
                        <h5 class="card-title">Simple Card</h5>
                        <p>A card without header and footer. Just the body content.</p>
                        <a href="#" class="btn btn-link">Learn more →</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="card"&gt;
    &lt;div class="card-header"&gt;
        &lt;h5 class="card-title"&gt;Job Card #1234&lt;/h5&gt;
    &lt;/div&gt;
    &lt;div class="card-body"&gt;
        &lt;p&gt;&lt;strong&gt;Customer:&lt;/strong&gt; Rahul Sharma&lt;/p&gt;
        &lt;p&gt;&lt;strong&gt;Vehicle:&lt;/strong&gt; MH12AB1234&lt;/p&gt;
        &lt;span class="badge badge-warning"&gt;In Progress&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="card-footer"&gt;
        &lt;button class="btn btn-primary btn-sm"&gt;View Details&lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== ALERTS ==================== -->
    <section id="alerts" class="docs-section">
        <h2 class="docs-section-title">⚠️ Alerts</h2>
        
        <div class="docs-preview">
            <div class="alert alert-success">
                ✅ <strong>Success!</strong> Mechanic added successfully.
            </div>
            <div class="alert alert-danger">
                ❌ <strong>Error!</strong> Failed to update job card.
            </div>
            <div class="alert alert-warning">
                ⚠️ <strong>Warning!</strong> This action cannot be undone.
            </div>
            <div class="alert alert-info">
                ℹ️ <strong>Info:</strong> New service available from tomorrow.
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;div class="alert alert-success"&gt;
    ✅ &lt;strong&gt;Success!&lt;/strong&gt; Mechanic added successfully.
&lt;/div&gt;

&lt;div class="alert alert-danger"&gt;
    ❌ &lt;strong&gt;Error!&lt;/strong&gt; Failed to update job card.
&lt;/div&gt;

&lt;div class="alert alert-warning"&gt;
    ⚠️ &lt;strong&gt;Warning!&lt;/strong&gt; This action cannot be undone.
&lt;/div&gt;

&lt;div class="alert alert-info"&gt;
    ℹ️ &lt;strong&gt;Info:&lt;/strong&gt; New service available.
&lt;/div&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== BADGES ==================== -->
    <section id="badges" class="docs-section">
        <h2 class="docs-section-title">🏷️ Badges</h2>
        
        <div class="docs-preview">
            <div class="d-flex flex-wrap gap-3">
                <span class="badge badge-primary">Primary</span>
                <span class="badge badge-success">Completed</span>
                <span class="badge badge-danger">Urgent</span>
                <span class="badge badge-warning">Pending</span>
                <span class="badge badge-info">New</span>
            </div>
        </div>
        <div class="docs-code">
            <pre><code>&lt;span class="badge badge-primary"&gt;Primary&lt;/span&gt;
&lt;span class="badge badge-success"&gt;Completed&lt;/span&gt;
&lt;span class="badge badge-danger"&gt;Urgent&lt;/span&gt;
&lt;span class="badge badge-warning"&gt;Pending&lt;/span&gt;
&lt;span class="badge badge-info"&gt;New&lt;/span&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== TABLES ==================== -->
    <section id="tables" class="docs-section">
        <h2 class="docs-section-title">📊 Tables</h2>
        
        <div class="docs-preview" style="overflow-x: auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Mechanic</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>Rahul Sharma</td>
                        <td>MH12AB1234</td>
                        <td>John Smith</td>
                        <td><span class="badge badge-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-ghost">✏️</button>
                            <button class="btn btn-sm btn-ghost text-danger">🗑️</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#1002</td>
                        <td>Priya Patel</td>
                        <td>GJ05CD5678</td>
                        <td>Mike Johnson</td>
                        <td><span class="badge badge-warning">In Progress</span></td>
                        <td>
                            <button class="btn btn-sm btn-ghost">✏️</button>
                            <button class="btn btn-sm btn-ghost text-danger">🗑️</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#1003</td>
                        <td>Amit Kumar</td>
                        <td>DL10EF9012</td>
                        <td>Sarah Davis</td>
                        <td><span class="badge badge-danger">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-ghost">✏️</button>
                            <button class="btn btn-sm btn-ghost text-danger">🗑️</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="docs-code">
            <pre><code>&lt;table class="table table-striped"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;ID&lt;/th&gt;
            &lt;th&gt;Customer&lt;/th&gt;
            &lt;th&gt;Vehicle&lt;/th&gt;
            &lt;th&gt;Status&lt;/th&gt;
            &lt;th&gt;Actions&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;tr&gt;
            &lt;td&gt;#1001&lt;/td&gt;
            &lt;td&gt;Rahul Sharma&lt;/td&gt;
            &lt;td&gt;MH12AB1234&lt;/td&gt;
            &lt;td&gt;&lt;span class="badge badge-success"&gt;Completed&lt;/span&gt;&lt;/td&gt;
            &lt;td&gt;
                &lt;button class="btn btn-sm btn-ghost"&gt;✏️&lt;/button&gt;
                &lt;button class="btn btn-sm btn-ghost"&gt;🗑️&lt;/button&gt;
            &lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== MODALS ==================== -->
    <section id="modals" class="docs-section">
        <h2 class="docs-section-title">🪟 Modals</h2>
        
        <div class="docs-preview">
            <div class="d-flex gap-3">
                <button class="btn btn-primary" onclick="openModal()">Open Simple Modal</button>
                <button class="btn btn-success" onclick="openFormModal()">Open Form Modal</button>
            </div>
        </div>
        
        <div class="modal-backdrop" id="demoModal" onclick="closeModal(event)">
            <div class="modal" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Mechanic</h5>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Specialization</label>
                        <input type="text" class="form-control" placeholder="e.g., Engine, Brakes">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" placeholder="Enter phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" onclick="closeModal()">Cancel</button>
                    <button class="btn btn-primary">Save Mechanic</button>
                </div>
            </div>
        </div>
        
        <div class="docs-code">
            <pre><code>&lt;!-- Modal Trigger --&gt;
&lt;button class="btn btn-primary" onclick="openModal()"&gt;Open Modal&lt;/button&gt;

&lt;!-- Modal Structure --&gt;
&lt;div class="modal-backdrop" id="myModal"&gt;
    &lt;div class="modal"&gt;
        &lt;div class="modal-header"&gt;
            &lt;h5 class="modal-title"&gt;Modal Title&lt;/h5&gt;
            &lt;button class="modal-close" onclick="closeModal()"&gt;&times;&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class="modal-body"&gt;
            &lt;!-- Form or content here --&gt;
        &lt;/div&gt;
        &lt;div class="modal-footer"&gt;
            &lt;button class="btn btn-outline-secondary"&gt;Cancel&lt;/button&gt;
            &lt;button class="btn btn-primary"&gt;Save&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- JavaScript --&gt;
&lt;script&gt;
function openModal() {
    document.getElementById('myModal').classList.add('show');
}

function closeModal() {
    document.getElementById('myModal').classList.remove('show');
}
&lt;/script&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== NAVBAR SECTION ==================== -->
    <section id="navbar-docs" class="docs-section">
        <h2 class="docs-section-title">🧭 Navbar</h2>
        
        <p>The navbar at the top of this page demonstrates the complete navigation component.</p>
        
        <div class="docs-code">
            <pre><code>&lt;nav class="navbar"&gt;
    &lt;a href="#" class="navbar-brand"&gt;
        🔧 GarageMitra
    &lt;/a&gt;
    
    &lt;button class="navbar-toggle" onclick="toggleNav()"&gt;
        &lt;span&gt;&lt;/span&gt;
        &lt;span&gt;&lt;/span&gt;
        &lt;span&gt;&lt;/span&gt;
    &lt;/button&gt;
    
    &lt;ul class="navbar-nav" id="navbarNav"&gt;
        &lt;li class="nav-item"&gt;
            &lt;a href="#" class="nav-link active"&gt;Dashboard&lt;/a&gt;
        &lt;/li&gt;
        &lt;li class="nav-item"&gt;
            &lt;a href="#" class="nav-link"&gt;Job Cards&lt;/a&gt;
        &lt;/li&gt;
        &lt;li class="nav-item dropdown"&gt;
            &lt;a href="#" class="nav-link"&gt;More ▾&lt;/a&gt;
            &lt;div class="dropdown-menu"&gt;
                &lt;a href="#" class="dropdown-item"&gt;Mechanics&lt;/a&gt;
                &lt;a href="#" class="dropdown-item"&gt;Services&lt;/a&gt;
                &lt;div class="dropdown-divider"&gt;&lt;/div&gt;
                &lt;a href="#" class="dropdown-item"&gt;Settings&lt;/a&gt;
            &lt;/div&gt;
        &lt;/li&gt;
    &lt;/ul&gt;
    
    &lt;div class="navbar-actions"&gt;
        &lt;button class="btn btn-ghost btn-icon"&gt;🔔&lt;/button&gt;
        &lt;button class="btn btn-primary"&gt;Logout&lt;/button&gt;
    &lt;/div&gt;
&lt;/nav&gt;

&lt;script&gt;
function toggleNav() {
    document.getElementById('navbarNav').classList.toggle('show');
}
&lt;/script&gt;</code></pre>
        </div>
    </section>

    <!-- ==================== UTILITIES ==================== -->
    <section id="utilities" class="docs-section">
        <h2 class="docs-section-title">🛠️ Utility Classes</h2>
        
        <h4>Spacing</h4>
        <div class="docs-code">
            <button class="copy-btn" onclick="copyCode(this)">📋 Copy</button>
            <pre><code>&lt;!-- Margin --&gt;
.m-0, .m-1, .m-2, .m-3, .m-4          /* All sides */
.mt-0 to .mt-8                         /* Margin top */
.mb-0 to .mb-8                         /* Margin bottom */

&lt;!-- Padding --&gt;
.p-0, .p-1, .p-2, .p-3, .p-4, .p-6    /* All sides */</code></pre>
        </div>

        <h4>Display & Flexbox</h4>
        <div class="docs-code">
            <button class="copy-btn" onclick="copyCode(this)">📋 Copy</button>
            <pre><code>.d-flex, .d-block, .d-none, .d-inline-flex
.flex-wrap, .flex-column
.align-items-center
.justify-content-center, .justify-content-between, .justify-content-end
.gap-1, .gap-2, .gap-3, .gap-4</code></pre>
        </div>

        <h4>Text & Colors</h4>
        <div class="docs-code">
            <button class="copy-btn" onclick="copyCode(this)">📋 Copy</button>
            <pre><code>.text-center, .text-left, .text-right
.text-primary, .text-success, .text-danger, .text-warning, .text-muted
.bg-primary, .bg-success, .bg-danger, .bg-light, .bg-white</code></pre>
        </div>

        <h4>Borders & Shadows</h4>
        <div class="docs-code">
            <button class="copy-btn" onclick="copyCode(this)">📋 Copy</button>
            <pre><code>.rounded, .rounded-lg, .rounded-full
.shadow-sm, .shadow-md, .shadow-lg</code></pre>
        </div>

        <h4>Sizing</h4>
        <div class="docs-code">
            <button class="copy-btn" onclick="copyCode(this)">📋 Copy</button>
            <pre><code>.w-100    /* width: 100% */
.h-100    /* height: 100% */</code></pre>
        </div>
    </section>

        </div> <!-- End docs-content -->
    </div> <!-- End docs-layout -->

    <!-- Footer -->
    <footer class="text-center mt-8 p-6" style="border-top: 1px solid var(--gray-200);">
        <p class="text-muted mb-0">
            GarageMitra Design System v1.0 | Built with ❤️ for better garage management
        </p>
    </footer>

</div>

<!-- Form Modal -->
<div class="modal-backdrop" id="formModal" onclick="closeFormModal(event)">
    <div class="modal" onclick="event.stopPropagation()" style="max-width: 500px;">
        <div class="modal-header">
            <h5 class="modal-title">Add New Job Card</h5>
            <button class="modal-close" onclick="closeFormModal()">&times;</button>
        </div>
        <form id="jobCardForm">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label required">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" placeholder="Enter customer name" required>
                </div>
                <div class="d-flex gap-3">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label required">Phone</label>
                        <input type="tel" class="form-control" name="phone" placeholder="10-digit number" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="email@example.com">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label required">Vehicle Number</label>
                    <input type="text" class="form-control" name="vehicle_number" placeholder="e.g., MH12AB1234" required>
                </div>
                <div class="d-flex gap-3">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Vehicle Make</label>
                        <input type="text" class="form-control" name="make" placeholder="e.g., Honda">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Vehicle Model</label>
                        <input type="text" class="form-control" name="model" placeholder="e.g., City">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Assign Mechanic</label>
                    <select class="form-control" name="mechanic_id">
                        <option value="">Select mechanic...</option>
                        <option value="1">John Smith - Engine Specialist</option>
                        <option value="2">Mike Johnson - Brake Expert</option>
                        <option value="3">Sarah Davis - Electrical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Issue Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Describe the issue..."></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="urgent" id="urgentCheck">
                    <label class="form-check-label" for="urgentCheck">Mark as urgent</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="closeFormModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Job Card</button>
            </div>
        </form>
    </div>
</div>

<script>
// Mobile nav toggle
function toggleNav() {
    document.getElementById('navbarNav').classList.toggle('show');
}

// Modal functions
function openModal() {
    document.getElementById('demoModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeModal(event) {
    if (!event || event.target.classList.contains('modal-backdrop')) {
        document.getElementById('demoModal').classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Form Modal functions
function openFormModal() {
    document.getElementById('formModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeFormModal(event) {
    if (!event || event.target.classList.contains('modal-backdrop')) {
        document.getElementById('formModal').classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Handle form submission
document.getElementById('jobCardForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Job Card Created Successfully!');
    closeFormModal();
    this.reset();
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
        closeFormModal();
    }
});

// Copy Code Function
function copyCode(button) {
    const codeBlock = button.nextElementSibling.querySelector('code');
    const text = codeBlock.innerText;
    
    navigator.clipboard.writeText(text).then(() => {
        button.innerHTML = '✅ Copied!';
        button.classList.add('copied');
        
        setTimeout(() => {
            button.innerHTML = '📋 Copy';
            button.classList.remove('copied');
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
        button.innerHTML = '❌ Failed';
        setTimeout(() => {
            button.innerHTML = '📋 Copy';
        }, 2000);
    });
}

// Add copy buttons to all code blocks on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.docs-code').forEach(codeBlock => {
        if (!codeBlock.querySelector('.copy-btn')) {
            const copyBtn = document.createElement('button');
            copyBtn.className = 'copy-btn';
            copyBtn.innerHTML = '📋 Copy';
            copyBtn.onclick = function() { copyCode(this); };
            codeBlock.insertBefore(copyBtn, codeBlock.firstChild);
        }
    });
});

// Sidebar active state on scroll
const sections = document.querySelectorAll('section[id]');
const sidebarLinks = document.querySelectorAll('.sidebar-nav a');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - 100) {
            current = section.getAttribute('id');
        }
    });

    sidebarLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
            link.classList.add('active');
        }
    });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// ==================== Multiple Image Upload ====================
const multiImageInput = document.getElementById('multiImageInput');
const imageUploadWrapper = document.getElementById('imageUploadWrapper');
const imageUploadBox = document.getElementById('imageUploadBox');
let selectedFiles = [];

if (multiImageInput && imageUploadWrapper && imageUploadBox) {
    // Handle file selection via input
    multiImageInput.addEventListener('change', function(e) {
        handleImageFiles(e.target.files);
    });

    // Drag and drop handlers on the + box
    imageUploadBox.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('dragover');
    });

    imageUploadBox.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('dragover');
    });

    imageUploadBox.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        handleImageFiles(files);
    });
}

function handleImageFiles(files) {
    Array.from(files).forEach((file) => {
        // Only process image files
        if (!file.type.startsWith('image/')) {
            alert(`"${file.name}" is not an image file.`);
            return;
        }

        // Check file size (max 10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert(`"${file.name}" is too large. Max size is 10MB.`);
            return;
        }

        selectedFiles.push(file);
        const fileIndex = selectedFiles.length - 1;

        // Create preview using FileReader
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewItem = document.createElement('div');
            previewItem.className = 'image-preview-item';
            previewItem.dataset.index = fileIndex;
            previewItem.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}">
                <button type="button" class="remove-btn" onclick="removeImage(${fileIndex})" title="Remove image">×</button>
            `;
            // Insert BEFORE the + button so images appear to the left
            imageUploadWrapper.insertBefore(previewItem, imageUploadBox);
        };
        reader.readAsDataURL(file);
    });

    // Clear the input so same files can be selected again if needed
    multiImageInput.value = '';
}

function removeImage(index) {
    // Remove from selectedFiles array
    selectedFiles[index] = null;
    
    // Remove preview element with animation
    const previewItem = document.querySelector(`.image-preview-item[data-index="${index}"]`);
    if (previewItem) {
        previewItem.style.transform = 'scale(0)';
        previewItem.style.opacity = '0';
        setTimeout(() => {
            previewItem.remove();
        }, 200);
    }
}

// Get selected files (excluding removed ones) - useful for form submission
function getSelectedFiles() {
    return selectedFiles.filter(file => file !== null);
}

// Clear all images
function clearAllImages() {
    selectedFiles = [];
    document.querySelectorAll('.image-preview-item').forEach(item => item.remove());
}
</script>

</body>
</html>
