<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunaulo - Care Beyond Borders</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }

        body { background: #f1faf1; color: #212121; }

        /* ── TOP BAR ── */
        .topbar {
            background: #2e7d32;
            padding: 14px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-size: 26px;
            font-weight: bold;
            color: white;
            letter-spacing: 1px;
        }

        .logo-np { font-size: 14px; color: #a5d6a7; margin-left: 8px; font-weight: normal; }

        /* Language toggle */
        .lang-toggle {
            display: flex;
            gap: 0;
            border: 2px solid #a5d6a7;
            border-radius: 25px;
            overflow: hidden;
        }

        .lang-btn {
            padding: 7px 20px;
            background: transparent;
            color: #a5d6a7;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .lang-btn.active {
            background: white;
            color: #2e7d32;
        }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 50%, #43a047 100%);
            padding: 80px 40px 70px;
            text-align: center;
            color: white;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,0.15);
            color: #c8e6c9;
            font-size: 13px;
            padding: 6px 18px;
            border-radius: 20px;
            margin-bottom: 22px;
            letter-spacing: 1px;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 900;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .hero-np-title {
            font-size: 22px;
            color: #a5d6a7;
            margin-bottom: 22px;
            font-style: italic;
        }

        .hero p {
            font-size: 19px;
            color: #c8e6c9;
            max-width: 600px;
            margin: 0 auto 36px;
            line-height: 1.6;
        }

        .hero-btns {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: white;
            color: #2e7d32;
            padding: 15px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 700;
            transition: 0.2s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        }

        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.2); }

        .btn-outline {
            background: transparent;
            color: white;
            padding: 15px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 700;
            border: 2px solid rgba(255,255,255,0.6);
            transition: 0.2s;
        }

        .btn-outline:hover { background: rgba(255,255,255,0.1); transform: translateY(-3px); }

        /* ── FEATURES ── */
        .features {
            padding: 70px 40px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .section-sub {
            text-align: center;
            color: #777;
            font-size: 15px;
            margin-bottom: 48px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px 26px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            transition: 0.2s;
            border-top: 4px solid #43a047;
        }

        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 28px rgba(0,0,0,0.11); }

        .feature-icon { font-size: 40px; margin-bottom: 16px; }

        .feature-card h3 {
            font-size: 18px;
            color: #1b5e20;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .feature-card p { font-size: 14px; color: #666; line-height: 1.6; }

        /* ── WHO IS IT FOR ── */
        .for-section {
            background: #e8f5e9;
            padding: 60px 40px;
        }

        .for-inner {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .for-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            text-align: center;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .for-card .icon { font-size: 52px; margin-bottom: 14px; }

        .for-card h3 {
            font-size: 20px;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .for-card p { font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 22px; }

        .for-card a {
            display: inline-block;
            background: #2e7d32;
            color: white;
            padding: 11px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: 0.2s;
        }

        .for-card a:hover { background: #1b5e20; }

        /* ── FOOTER ── */
        .landing-footer {
            background: #1b5e20;
            color: #a5d6a7;
            text-align: center;
            padding: 22px;
            font-size: 14px;
        }

        .landing-footer span { color: white; font-weight: bold; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            .hero h1        { font-size: 36px; }
            .hero p         { font-size: 16px; }
            .topbar         { padding: 12px 20px; }
            .for-inner      { grid-template-columns: 1fr; }
            .features       { padding: 50px 20px; }
            .for-section    { padding: 50px 20px; }
        }
    </style>
</head>
<body>

<!-- ══════════════════════════════════
     TOP BAR
══════════════════════════════════ -->
<div class="topbar">
    <div>
        <span class="logo-text">Sunaulo 💚</span>
        <span class="logo-np" id="logo-np">सुनौलो</span>
    </div>
    <div class="lang-toggle">
        <button class="lang-btn active" id="btn-en" onclick="setLang('en')">English</button>
        <button class="lang-btn"        id="btn-ne" onclick="setLang('ne')">नेपाली</button>
    </div>
</div>

<!-- ══════════════════════════════════
     HERO
══════════════════════════════════ -->
<div class="hero">
    <div class="hero-badge" data-en="Elderly Care Platform" data-ne="वृद्ध हेरचाह मञ्च">
        Elderly Care Platform
    </div>

    <h1>SUNAULO</h1>
    <div class="hero-np-title">सुनौलो</div>

    <p data-en="A safe and simple digital home for your elderly loved ones — manage health, medicines, memories and emergencies all in one place."
       data-ne="तपाईंका वृद्ध प्रियजनहरूका लागि सुरक्षित र सरल डिजिटल घर — स्वास्थ्य, औषधि, सम्झना र आपतकाल एकै ठाउँमा व्यवस्थापन गर्नुहोस्।">
        A safe and simple digital home for your elderly loved ones — manage health, medicines, memories and emergencies all in one place.
    </p>

    <div class="hero-btns">
        <a href="register.php" class="btn-primary"
           data-en="Get Started — Register"
           data-ne="सुरु गर्नुहोस् — दर्ता">
            Get Started — Register
        </a>
        <a href="login.php" class="btn-outline"
           data-en="Already have account? Login"
           data-ne="खाता छ? लगइन गर्नुहोस्">
            Already have account? Login
        </a>
    </div>
</div>

<!-- ══════════════════════════════════
     FEATURES
══════════════════════════════════ -->
<div class="features">
    <h2 class="section-title"
        data-en="Everything Your Elder Needs"
        data-ne="तपाईंका वृद्धलाई चाहिने सबै कुरा">
        Everything Your Elder Needs
    </h2>
    <p class="section-sub"
       data-en="Built specifically for elderly people and their families"
       data-ne="वृद्ध मानिसहरू र तिनका परिवारका लागि विशेष रूपमा बनाइएको">
        Built specifically for elderly people and their families
    </p>

    <div class="feature-grid">

        <div class="feature-card">
            <div class="feature-icon">💊</div>
            <h3 data-en="Medicine Reminder"   data-ne="औषधि स्मरण">Medicine Reminder</h3>
            <p  data-en="Never miss a dose. Track Pending, Taken, and Missed medicines with daily schedules."
                data-ne="कुनै पनि डोज नछुटोस्। दैनिक तालिकासहित Pending, Taken, र Missed औषधिहरू ट्र्याक गर्नुहोस्।">
                Never miss a dose. Track Pending, Taken, and Missed medicines with daily schedules.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">😊</div>
            <h3 data-en="Mood Tracker"   data-ne="मनस्थिति ट्र्याकर">Mood Tracker</h3>
            <p  data-en="Record daily mood — Happy, Sad, Anxious, Excited and more — with notes and history."
                data-ne="दैनिक मनस्थिति रेकर्ड गर्नुहोस् — खुसी, दुखी, चिन्तित, उत्साहित — नोट र इतिहाससहित।">
                Record daily mood — Happy, Sad, Anxious, Excited and more — with notes and history.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">❤️</div>
            <h3 data-en="Health Records"   data-ne="स्वास्थ्य अभिलेख">Health Records</h3>
            <p  data-en="Log blood pressure, sleep hours, water intake and weight. Track your health over time."
                data-ne="रक्तचाप, निद्राको घण्टा, पानी र तौल लग गर्नुहोस्। समयसँगै स्वास्थ्य ट्र्याक गर्नुहोस्।">
                Log blood pressure, sleep hours, water intake and weight. Track your health over time.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🆘</div>
            <h3 data-en="SOS Emergency Alert"   data-ne="SOS आपतकालीन अलर्ट">SOS Emergency Alert</h3>
            <p  data-en="One tap to send an emergency alert with your GPS location to your family immediately."
                data-ne="एक टचमा आफ्नो GPS स्थानसहित परिवारलाई तुरुन्त आपतकालीन अलर्ट पठाउनुहोस्।">
                One tap to send an emergency alert with your GPS location to your family immediately.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">🖼️</div>
            <h3 data-en="Photo Memories"   data-ne="तस्बिर सम्झनाहरू">Photo Memories</h3>
            <p  data-en="Upload and keep precious family photos. Relive your cherished moments anytime."
                data-ne="बहुमूल्य पारिवारिक तस्बिरहरू अपलोड गरी राख्नुहोस्। आफ्ना प्रिय क्षणहरू जुनसुकै बेला याद गर्नुहोस्।">
                Upload and keep precious family photos. Relive your cherished moments anytime.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">📋</div>
            <h3 data-en="Medical Contacts"   data-ne="चिकित्सा सम्पर्कहरू">Medical Contacts</h3>
            <p  data-en="Save doctors, hospitals, pharmacies and ambulance numbers — call them in one tap."
                data-ne="चिकित्सक, अस्पताल, फार्मेसी र एम्बुलेन्स नम्बरहरू सुरक्षित राख्नुहोस् — एक टचमा फोन गर्नुहोस्।">
                Save doctors, hospitals, pharmacies and ambulance numbers — call them in one tap.
            </p>
        </div>

    </div>
</div>

<!-- ══════════════════════════════════
     WHO IS IT FOR
══════════════════════════════════ -->
<div class="for-section">
    <h2 class="section-title" style="margin-bottom:10px;"
        data-en="Who is Sunaulo for?"
        data-ne="सुनौलो कसका लागि हो?">
        Who is Sunaulo for?
    </h2>
    <p class="section-sub"
       data-en="Two roles — Elders and Family Members"
       data-ne="दुई भूमिका — वृद्ध र परिवारका सदस्यहरू">
        Two roles — Elders and Family Members
    </p>

    <div class="for-inner">

        <div class="for-card">
            <div class="icon">👴</div>
            <h3 data-en="I am an Elder"   data-ne="म वृद्ध हुँ">I am an Elder</h3>
            <p  data-en="Manage your medicines, track your mood and health, store memories and contact your doctor — all from one simple screen."
                data-ne="आफ्नो औषधि व्यवस्थापन गर्नुहोस्, मनस्थिति र स्वास्थ्य ट्र्याक गर्नुहोस्, सम्झनाहरू राख्नुहोस् र आफ्नो डाक्टरलाई सम्पर्क गर्नुहोस् — एउटै सरल स्क्रिनबाट।">
                Manage your medicines, track your mood and health, store memories and contact your doctor — all from one simple screen.
            </p>
            <a href="register.php?role=elder"
               data-en="Register as Elder"
               data-ne="वृद्धको रूपमा दर्ता गर्नुहोस्">
               Register as Elder
            </a>
        </div>

        <div class="for-card">
            <div class="icon">👨‍👩‍👧</div>
            <h3 data-en="I am a Family Member"   data-ne="म परिवारको सदस्य हुँ">I am a Family Member</h3>
            <p  data-en="Stay connected with your elderly parents from anywhere. Monitor their health, add medicines and be ready for emergencies."
                data-ne="जहाँबाट पनि आफ्ना वृद्ध आमाबुबासँग जोडिएर रहनुहोस्। तिनको स्वास्थ्य अनुगमन गर्नुहोस्, औषधि थप्नुहोस् र आपतकालका लागि तयार रहनुहोस्।">
                Stay connected with your elderly parents from anywhere. Monitor their health, add medicines and be ready for emergencies.
            </p>
            <a href="register.php?role=family"
               data-en="Register as Family"
               data-ne="परिवारको रूपमा दर्ता गर्नुहोस्">
               Register as Family
            </a>
        </div>

    </div>
</div>

<!-- ══════════════════════════════════
     FOOTER
══════════════════════════════════ -->
<div class="landing-footer">
    <span>Sunaulo 💚</span> &nbsp;—&nbsp;
    <span data-en="Care Beyond Borders" data-ne="सीमाभन्दा पर हेरचाह">Care Beyond Borders</span>
</div>

<!-- ══════════════════════════════════
     LANGUAGE SWITCH SCRIPT
══════════════════════════════════ -->
<script>
    // Load saved language (default: English)
    const saved = localStorage.getItem('sunaulo_lang') || 'en';
    setLang(saved);

    function setLang(lang) {
        localStorage.setItem('sunaulo_lang', lang);

        // Toggle active button
        document.getElementById('btn-en').classList.toggle('active', lang === 'en');
        document.getElementById('btn-ne').classList.toggle('active', lang === 'ne');

        // Switch all elements that have data-en / data-ne
        document.querySelectorAll('[data-en]').forEach(el => {
            el.textContent = el.getAttribute('data-' + lang);
        });

        // Update html lang attribute
        document.getElementById('html-root').setAttribute('lang', lang === 'ne' ? 'ne' : 'en');
    }
</script>

</body>
</html>