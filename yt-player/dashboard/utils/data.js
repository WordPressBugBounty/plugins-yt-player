import { themeImage } from "./icons";

const slug = "yt-player";
export const dashboardInfo = (info) => {
  const { version, isPremium, hasPro } = info;

  const proSuffix = isPremium ? " Pro" : "";

  return {
    name: `YT Player${proSuffix}`,
    displayName: `YT Player${proSuffix} - Customizable YouTube Video Player`,
    description:
      "A modern, accessible, fully customizable & user-friendly YouTube Video Player for WordPress.",
    slug,
    logo: `https://ps.w.org/${slug}/assets/icon-128x128.png`,
    banner: `https://ps.w.org/${slug}/assets/banner-772x250.png`,
    video: 'https://youtu.be/NGvVtSXcZK4',
    isYoutube: true,
    version,
    isPremium,
    hasPro,
    pages: {
      org: `https://wordpress.org/plugins/${slug}/`,
      landing: `https://bplugins.com/products/${slug}/`,
      docs: `https://bplugins.com/docs/${slug}/`,
      pricing: `https://bplugins.com/products/${slug}/#pricing`,
    },
    freemius: {
      product_id: 5836,
      plan_id: 9545,
      public_key: "pk_829fc74e7bb67d3d555c68048933d",
    },
    options: { title: "YT Player" }
  };
};

export const demoInfo = {
  title: "Live Overview",
  description: "Click on any section to view it live",
  layout: "list",
  allInOneLabel: "See All Demos",
  allInOneLink: "https://bplugins.com/products/yt-player/#demos",
  demos: [
    {
      icon: themeImage,
      title: "The Player in Frontend",
      description: "Shows the YouTube player on the live site.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/MyqKRq5c/screenshot-1.png",
    },
    {
      icon: themeImage,
      title: "The Player With All Controls",
      description: "Shows the YouTube player with all controls enabled.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/5V3xB8H/screenshot-2.png",
    },
    {
      icon: themeImage,
      title: "The Player without controls",
      description: "Shows the YouTube player without any controls.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/nM7wzq77/screenshot-3.png",
    },
    {
      icon: themeImage,
      title: "Player With TimeLine Block",
      description: "Shows the YouTube player with a visible timeline.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/5gZQZtR1/screenshot-4.png",
    },
    {
      icon: themeImage,
      title: "Player With Brand Logo",
      description: "Displays the YouTube player with a custom brand logo.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/WvLR2K3c/screenshot-5.png",
    },
    {
      icon: themeImage,
      title: "ShortCode",
      description: "Generates a shortcode to embed the YouTube player anywhere.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/2343zzd4/screenshot-6.png",
    },
    {
      icon: themeImage,
      title: "Controls Settings",
      description: "Adjust playback controls and visibility options.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/bR8f0QbQ/screenshot-7.png",
    },
    {
      icon: themeImage,
      title: "Controls Settings",
      description: "Adjust playback controls and visibility options.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/GfG12xBN/screenshot-8.png",
    },
    {
      icon: themeImage,
      title: "Gutenberg Block Settings",
      description: "Customize YT player options within Gutenberg editor.",
      category: "",
      type: "image",
      url: "https://i.ibb.co.com/tT7J9Kr6/screenshot-9.png",
    },
  ],
};


export const pricingInfo = {
  cycles: [
    {
      cycle: "lifetime",
      label: "Lifetime",
      isDefault: true,
    },
  ],
  plans: [
    {
      name: "Single Site",
      quantity: 1,
      prices: {
        lifetime: "99",
      },
      pricePrefix: "",
      priceSuffix: "",
      isFeatured: false,
      note: "",
    },
    {
      name: "3 Sites",
      quantity: 3,
      prices: {
        lifetime: "219.99",
      },
      pricePrefix: "",
      priceSuffix: "",
      isFeatured: true,
      note: "",
    },
    {
      name: "Unlimited Sites",
      quantity: "null",
      prices: {
        lifetime: "499",
      },
      pricePrefix: "",
      priceSuffix: "",
      isFeatured: false,
      note: "",
    },
  ],
  features: [
    "Add a Brand Logo on Videos",
    "Upload Custom Thumbnails",
    "Auto-Repeat Playback",
    "Show Thumbnail When Paused",
    "Hide Controls on Pause",
    "Floating Mini Player While Scrolling",
    "Muted options for Auto-Play",
    "Automatically starts video playback when the page loads.",
    "Apply the Seek Time",
    "Hide YouTube UI",
    "Save Preset Design",
    "Customize the Player’s Look and Feel"
  ],
  button: {
    label: "Buy Now ➜",
  },
  featured: {
    text: "Best Value",
  },
};

export const featureCompareInfo = {
  title: "Features",
  plans: [
    {
      id: "zxcvbnm", //important
      name: "Free Plan",
      color: "#485781",
    },
    {
      id: "lhmjqhk", //important
      name: `<span style='color: #485781;'>Pro Start from </span><span style='font-size: 1.3em;'>&dollar; 99/lifetime</span>`,
      color: "#146EF5",
    },
  ],
  features: [
    {
      label: "Easy YouTube Embed with Shortcode",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Works with YouTube Video ID or URL",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Fully Responsive Layout",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Fullscreen Support",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Fast & Lightweight",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Shortcode Anywhere Support",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Toggle Player Controls",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Keyboard & Accessibility Support",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Built with HTML5 and Plyr.js",
      plans: ["zxcvbnm", "lhmjqhk"],
    },
    {
      label: "Add a Brand Logo on Videos",
      plans: ["lhmjqhk"],
    },
    {
      label: "Upload Custom Thumbnails",
      plans: ["lhmjqhk"],
    },
    {
      label: "Auto-Repeat Playback",
      plans: ["lhmjqhk"],
    },
    {
      label: "Show Thumbnail When Paused",
      plans: ["lhmjqhk"],
    },
    {
      label: "Hide Controls on Pause",
      plans: ["lhmjqhk"],
    },
    {
      label: "Floating Mini Player While Scrolling",
      plans: ["lhmjqhk"],
    },
    {
      label: "Muted options for Auto-Play",
      plans: ["lhmjqhk"],
    },
    {
      label: "Automatically starts video playback when the page loads.",
      plans: ["lhmjqhk"],
    },
    {
      label: "Apply the Seek Time",
      plans: ["lhmjqhk"],
    },
    {
      label: "Hide YouTube UI",
      plans: ["lhmjqhk"],
    },
    {
      label: "Save Preset Design",
      plans: ["lhmjqhk"],
    },
    {
      label: "Customize the Player’s Look and Feel",
      plans: ["lhmjqhk"],
    },
    {
      label: "accessible yt player with timeline block",
      plans: ["lhmjqhk"],
    },
    {
      label: "Premium Animation and Effects",
      plans: ["lhmjqhk"],
    },
    {
      label: "Premium Customization Options",
      plans: ["lhmjqhk"],
    }
  ],
};