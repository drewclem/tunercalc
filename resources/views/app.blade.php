<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'TunerCalc') }}</title>
        
        <meta name="title" content="TunerCalc – Compression Ratio, Injector Size, Turbo Sizing & HP-to-Trap Speed Calculators" /><meta name="description" content="TunerCalc is a free suite of car performance calculators: compression ratio, fuel injector size, turbo sizing, and horsepower to trap speed. Fast, accurate, mobile-friendly tools for tuners, builders, and track enthusiasts." />
        <link rel="canonical" href="https://tunercalc.com/" />
        <meta name="keywords" content="car performance calculator, tuner calculator, automotive calculators, car tuning tools, online car calculator, car build calculator, horsepower calculator, torque calculator, compression ratio calculator, static compression ratior calculator, engine compression ratior calculator, bore and stroke calculator, piston compression calculator, injector size calculator, fuel injector calculator, fuel injector sizing tool, injector flow rate calculator, horsepower fule injector calculator, turbo sizing calculator, turbo calculator hp, turbo matching calculator, turbocharger size calculator, choose the right turbo calculator, hp to trap speed calculator, horsepiower to mph calculator, quarter mile trap speed calculator, drag racing calculator, dyno hp to trap speed" />

        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://tunercalc.com/" />
        <meta property="og:title" content="TunerCalc" />
        <meta property="og:description" content="TunerCalc is your free online performance toolbox. Calculate compression ratio, injector size, turbo sizing, and horsepower to trap speed with fast, accurate car tuning calculators." />
        <meta property="og:image" content="https://tunercalc.com/images/og-image.png" />

        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://tunercalc.com/" />
        <meta property="twitter:title" content="TunerCalc" />
        <meta property="twitter:description" content="TunerCalc is your free online performance toolbox. Calculate compression ratio, injector size, turbo sizing, and horsepower to trap speed with fast, accurate car tuning calculators." />
        <meta property="twitter:image" content="https://tunercalc.com/images/og-image.png" />

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8922717808328069"
     crossorigin="anonymous"></script>

        {{-- <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@graph": [
                {
                  "@type": "Organization",
                  "name": "TunerCalc",
                  "url": "https://tunercalc.test",
                  "logo": "https://tunercalc.test/favicon.svg",
                  "description": "Professional automotive calculators for enthusiasts and professionals. Accurate calculations for performance modifications and engine tuning.",
                  "sameAs": [
                    "https://x.com/tunercalc",
                    "https://www.instagram.com/tunercalc"
                  ]
                },
                {
                  "@type": "WebSite",
                  "name": "TunerCalc",
                  "url": "https://tunercalc.test",
                  "description": "Professional automotive calculators for compression ratio, fuel injector sizing, turbo sizing, and trap speed calculations.",
                  "potentialAction": {
                    "@type": "SearchAction",
                    "target": "https://tunercalc.test/search?q={search_term_string}",
                    "query-input": "required name=search_term_string"
                  }
                },
                {
                  "@type": "ItemList",
                  "name": "Automotive Performance Calculators",
                  "description": "Professional-grade calculators for automotive performance modifications and engine tuning",
                  "url": "https://tunercalc.test/",
                  "itemListElement": [
                    {
                      "@type": "ListItem",
                      "position": 1,
                      "name": "Compression Ratio Calculator",
                      "description": "Calculate your engine's compression ratio using piston volume, head gasket thickness, bore, and stroke measurements.",
                      "url": "https://tunercalc.test/compression-ratio-calculator"
                    },
                    {
                      "@type": "ListItem",
                      "position": 2,
                      "name": "Fuel Injector Size Calculator",
                      "description": "Calculate required injector size based on target horsepower and desired duty cycle for optimal fuel delivery.",
                      "url": "https://tunercalc.test/injector-size-calculator"
                    },
                    {
                      "@type": "ListItem",
                      "position": 3,
                      "name": "Turbo Sizing Calculator",
                      "description": "Match turbocharger size to your horsepower goals and engine displacement for optimal performance.",
                      "url": "https://tunercalc.test/turbo-size-calculator"
                    },
                    {
                      "@type": "ListItem",
                      "position": 4,
                      "name": "HP to Trap Speed Calculator",
                      "description": "Estimate quarter-mile trap speed based on horsepower, weight, and drivetrain configuration.",
                      "url": "https://tunercalc.test/trap-speed-calculator"
                    }
                  ]
                },
                {
                  "@type": "FAQPage",
                  "mainEntity": [
                    {
                      "@type": "Question",
                      "name": "What calculators does TunerCalc offer?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "TunerCalc includes four professional-grade tools: Compression Ratio Calculator, Fuel Injector Size Calculator, Turbo Sizing Calculator, and HP to Trap Speed Calculator. Each calculator uses industry-standard formulas for accurate performance estimates."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Are the results accurate enough for tuning?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "TunerCalc uses widely accepted industry formulas and reasonable assumptions. Results are intended for planning and comparison; always verify with manufacturer data and professional tuning before making modifications."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Is TunerCalc free to use?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Yes. All calculators are completely free to use. No sign-up required, no hidden fees."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "Can I use TunerCalc on my phone at the track?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Absolutely. The site is mobile-first and loads fast, even on spotty connections. Perfect for quick calculations at the track or in the garage."
                      }
                    },
                    {
                      "@type": "Question",
                      "name": "What formulas does TunerCalc use?",
                      "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "TunerCalc uses industry-standard formulas including empirical compression ratio calculations, BSFC-based injector sizing, CFM-based turbo sizing, and power-to-weight trap speed formulas used by professional tuners."
                      }
                    }
                  ]
                }
              ]
            }
            </script> --}}

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
