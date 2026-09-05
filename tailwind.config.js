/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './www/**/*.php',
    './v1/**/*.php',
    './www/assets/js/**/*.js',
  ],
  // The core container plugin ties its responsive padding to container.screens,
  // which makes the two awkward to configure independently. .container is
  // defined by hand in src/input.css instead.
  corePlugins: { container: false },
  theme: {
    extend: {
      colors: {
        // Sampled from the Hathany Cosmos Foundation logo.
        // teal  = the blue figure and the "COSMOS" wordmark
        // ember = the orange figure and the "HATHANY" wordmark
        teal: {
          50:  '#EFF9FC',
          100: '#D5EFF7',
          200: '#AEE1EF',
          300: '#7DCCE0', // pale ray in the logo fan
          400: '#45B0CD',
          500: '#2494B5',
          600: '#1C7C9C', // primary brand teal
          700: '#1A6580',
          800: '#1B5369',
          900: '#1A4557',
          950: '#0E2C39',
        },
        ember: {
          50:  '#FFF6ED',
          100: '#FFEAD4',
          200: '#FDD2A8',
          300: '#F9C06B', // pale ray in the logo fan
          400: '#F5A03F', // mid ray
          500: '#F47B20', // primary brand orange
          600: '#E25F0E',
          700: '#BB460F',
          800: '#953814',
          900: '#783013',
          950: '#411606',
        },
        ink: {
          DEFAULT: '#132831',
          soft: '#3C525C',
          muted: '#6B818B',
          line: '#E3EBEF',
          wash: '#F5F9FB',
        },
      },
      fontFamily: {
        // Plus Jakarta Sans throughout: humanist rather than geometric, which
        // suits an organisation about people. One family keeps the payload down
        // and headings and body in the same voice.
        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-xl': ['clamp(2.75rem, 6.5vw, 5rem)', { lineHeight: '0.98', letterSpacing: '-0.035em', fontWeight: '700' }],
        'display-lg': ['clamp(2.25rem, 4.6vw, 3.75rem)', { lineHeight: '1.04', letterSpacing: '-0.03em', fontWeight: '700' }],
        'display-md': ['clamp(1.875rem, 3.2vw, 2.75rem)', { lineHeight: '1.1',  letterSpacing: '-0.025em', fontWeight: '700' }],
        'display-sm': ['clamp(1.5rem, 2.2vw, 2rem)',     { lineHeight: '1.18', letterSpacing: '-0.02em',  fontWeight: '600' }],
        'eyebrow':    ['0.8125rem', { lineHeight: '1', letterSpacing: '0.18em', fontWeight: '600' }],
      },
      boxShadow: {
        card:  '0 1px 2px rgba(19,40,49,.04), 0 8px 24px -12px rgba(19,40,49,.14)',
        lift:  '0 2px 4px rgba(19,40,49,.05), 0 24px 48px -20px rgba(19,40,49,.28)',
        glow:  '0 18px 48px -16px rgba(28,124,156,.5)',
        ember: '0 18px 48px -16px rgba(244,123,32,.5)',
      },
      borderRadius: {
        // Shared by buttons and form controls so they line up when adjacent.
        btn: '20px',
        '4xl': '2rem',
        '5xl': '2.75rem',
      },
      transitionDuration: { 400: '400ms', 600: '600ms', 800: '800ms' },
      transitionTimingFunction: {
        'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
        'spring':   'cubic-bezier(0.34, 1.56, 0.64, 1)',
      },
      keyframes: {
        'fade-up':    { '0%': { opacity: '0', transform: 'translateY(24px)' }, '100%': { opacity: '1', transform: 'none' } },
        'marquee':    { '0%': { transform: 'translateX(0)' }, '100%': { transform: 'translateX(-50%)' } },
        'float-slow': { '0%,100%': { transform: 'translateY(0) rotate(0deg)' }, '50%': { transform: 'translateY(-18px) rotate(2deg)' } },
        'pulse-ring': { '0%': { transform: 'scale(.9)', opacity: '.55' }, '70%': { transform: 'scale(1.35)', opacity: '0' }, '100%': { opacity: '0' } },
        'shimmer':    { '100%': { transform: 'translateX(100%)' } },
      },
      animation: {
        'fade-up':    'fade-up .8s cubic-bezier(0.16,1,0.3,1) both',
        'marquee':    'marquee 38s linear infinite',
        'float-slow': 'float-slow 9s ease-in-out infinite',
        'pulse-ring': 'pulse-ring 2.6s cubic-bezier(0.16,1,0.3,1) infinite',
      },
      backgroundImage: {
        'brand-grad': 'linear-gradient(115deg, #1C7C9C 0%, #2494B5 45%, #F47B20 100%)',
        'teal-grad':  'linear-gradient(150deg, #1C7C9C 0%, #14607A 100%)',
        'ember-grad': 'linear-gradient(150deg, #F5A03F 0%, #F47B20 55%, #E25F0E 100%)',
        'fan':        'conic-gradient(from 200deg at 50% 100%, #7DCCE0 0deg, #1C7C9C 40deg, transparent 80deg, transparent 280deg, #F47B20 320deg, #F9C06B 360deg)',
      },
    },
  },
  plugins: [],
}
