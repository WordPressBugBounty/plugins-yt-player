const slug = "yt-player";

export const dashboardInfo = (info) => {
  const { version, isPremium, hasPro, licenseActiveNonce } = info;

  const proSuffix = isPremium ? ' Pro' : '';

  return {
    name: `YT Player${proSuffix}`,
    displayName: `YT Player${proSuffix} - Embed and Customize Video Players`,
    description:
      "YT Player is a modern, lightweight, and fully customizable YouTube video player built for WordPress. Whether you’re adding a single video or creating a video-rich experience across posts, pages, or widget areas, this plugin makes it easy to embed YouTube videos with a sleek, accessible interface powered by HTML5 and the Plyr framework.",
    slug,
    version,
    isPremium,
    hasPro,
    displayOurPlugins: true,
    media: {
      logo: `https://ps.w.org/${slug}/assets/icon-128x128.png`,
      banner: `https://ps.w.org/${slug}/assets/banner-772x250.png`,
      thumbnail: `https://bplugins.com/wp-content/themes/b-technologies/assets/images/products/${slug}.png`,
      // proThumbnail: `https://bplugins.com/wp-content/themes/b-technologies/assets/images/products/${slug}-pro.png`,
      video: 'https://youtu.be/NGvVtSXcZK4',
      isYoutube: true
    },
    pages: {
      org: `https://wordpress.org/plugins/${slug}/`,
      landing: `https://bplugins.com/products/${slug}/`,
      docs: `https://bplugins.com/docs/${slug}/`,
      pricing: `https://bplugins.com/products/${slug}/pricing`,
    },
    freemius: {
      product_id: 5836,
      plan_id: 9545,
      public_key: 'pk_829fc74e7bb67d3d555c68048933d'
    },

    licenseActiveNonce,

    changelogs: [
      {
        version: '2.0.7 – 16 March 26',
        type: 'Update',
        list: [
          'Latest modern dashboard added',
          'dataset issue fixed'
        ]
      },
      {
        version: '2.0.6 – 21 Jan, 2026',
        type: 'fixed',
        list: [
          'Vulnerability patch problem fixed'
        ]
      },
      {
        version: '2.0.5 – 11 Dec, 2025',
        type: 'update',
        list: [
          'freemius sdk version updated',
          'applied logo on the brand name'
        ]
      },
      {
        version: '2.0.4 – 6 Nov, 2025',
        type: 'New',
        list: [
          'Video input field working both, ID or URL.'
        ]
      }
    ],

    proFeatures: [
      'Keep the video visible in a small floating player while visitors scroll down the page.',
      'Display your custom logo as an overlay on the video with adjustable position, size, and transparency.',
      'Replace the default YouTube preview with your own thumbnail image to better match your content.',
      'Automatically start video playback when the page loads, with the option to begin muted.',
      'Customize the player’s appearance, including colors, controls, and layout, to match your website design.',
      'Hide the default YouTube interface and branding for a cleaner, distraction-free video experience.'
    ],
    startButton: {
      label: 'Start Now',
      url: 'wp-admin/post-new.php?post_type=ytplayer'
    }
  }
}

export const demoInfo = {
  allInOneLabel: 'See All Demos',
  allInOneLink: 'https://bplugins.com/products/yt-player/#demos',
  demos: [
    {
      "title": "Default Preview",
      "description": "Default player preview here.",
      "url": "https://bblockswp.com/demo/yt-player-default-preview/",
      "icon": (<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V288H64V64H512z"></path></svg>),
      "type": 'iframe'
    },
    {
      "title": "Preview with play button",
      "description": "Starts muted and plays automatically.",
      "url": "https://yt-player.bplugins.com/demo/demo-2-player-with-no-control-button-except-large-play-button/",
      "icon": (<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V288H64V64H512z"></path></svg>),
      "type": 'iframe'
    },
    {
      "title": "200% width player",
      "description": "Player width set to 100%.",
      "url": "https://yt-player.bplugins.com/demo/demo-3-this-is-a-player-with-100-width-and-default-player-options/",
      "icon": (<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V288H64V64H512z"></path></svg>),
      "type": 'iframe'
    },
  ]
}

export const pricingInfo = {
  logo: `https://ps.w.org/${slug}/assets/icon-128x128.png`, // Optional
  pluginId: 5836,
  planId: 9545,
  licenses: [
    1,
    3,
    null
  ],
  button: {
    label: 'Buy Now ➜'
  },
  featured: {
    selected: 3, // choose from licenses item
  }
}