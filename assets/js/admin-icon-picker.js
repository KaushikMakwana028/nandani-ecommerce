/**
 * Nandani Admin Panel - Font Awesome Icon Picker & Smart Suggestions
 * Handles real-time icon search, autocomplete, typo correction, and visual icon browser.
 */

(function() {
    'use strict';

    // Comprehensive catalog of Font Awesome 6 icons curated for Nandani
    const FA_ICONS = [
        // Kitchen & Cooking / Food Preparation
        { icon: 'fa-solid fa-blender', label: 'Blender / Mixer Grinder', category: 'kitchen', keywords: ['mixer', 'blender', 'grinder', 'juicer', 'food processor', 'appliance', 'kitchen', 'smoothie', 'mix', 'puree'] },
        { icon: 'fa-solid fa-blender-phone', label: 'Blender Phone', category: 'kitchen', keywords: ['mixer', 'blender', 'appliance', 'phone'] },
        { icon: 'fa-solid fa-fire-burner', label: 'Gas Stove / Burner', category: 'kitchen', keywords: ['stove', 'gas stove', 'burner', 'cooktop', 'gas', 'flame', 'fire', 'cooking', 'range', 'hob', 'chulha'] },
        { icon: 'fa-solid fa-kitchen-set', label: 'Kitchen Set / Modular Kitchen', category: 'kitchen', keywords: ['kitchen', 'cooking', 'appliances', 'cabinets', 'set', 'utensils', 'oven', 'stove', 'mixer', 'grinder', 'pan'] },
        { icon: 'fa-solid fa-utensils', label: 'Utensils / Cutlery', category: 'kitchen', keywords: ['utensils', 'spoon', 'fork', 'knife', 'cutlery', 'kitchenware', 'dining', 'cookware', 'crockery', 'food'] },
        { icon: 'fa-solid fa-fire', label: 'Fire / Flame / Gas Stove', category: 'kitchen', keywords: ['fire', 'flame', 'gas', 'stove', 'hot', 'burner', 'heat', 'warmth', 'gas stove'] },
        { icon: 'fa-solid fa-bowl-food', label: 'Bowl Food / Mixing Bowl', category: 'kitchen', keywords: ['bowl', 'food', 'mixing', 'mixer', 'dish', 'recipe', 'meal', 'soup', 'salad', 'cooking'] },
        { icon: 'fa-solid fa-bowl-rice', label: 'Rice Cooker / Bowl', category: 'kitchen', keywords: ['rice', 'cooker', 'pressure cooker', 'bowl', 'steamer', 'grain', 'food'] },
        { icon: 'fa-solid fa-spoon', label: 'Spoon / Ladle', category: 'kitchen', keywords: ['spoon', 'cutlery', 'utensil', 'ladle', 'scoop', 'kitchen'] },
        { icon: 'fa-solid fa-plate-wheat', label: 'Plate / Dinnerware', category: 'kitchen', keywords: ['plate', 'dish', 'dinnerware', 'crockery', 'food', 'wheat'] },
        { icon: 'fa-solid fa-mug-hot', label: 'Hot Mug / Kettle / Coffee', category: 'kitchen', keywords: ['mug', 'cup', 'coffee', 'tea', 'kettle', 'hot', 'beverage', 'drink'] },
        { icon: 'fa-solid fa-bottle-water', label: 'Water Bottle / Flask', category: 'kitchen', keywords: ['bottle', 'water', 'flask', 'thermos', 'drink', 'container'] },
        { icon: 'fa-solid fa-burger', label: 'Burger / Fast Food', category: 'kitchen', keywords: ['burger', 'food', 'snack', 'cook'] },
        { icon: 'fa-solid fa-pizza-slice', label: 'Pizza / Baking', category: 'kitchen', keywords: ['pizza', 'baking', 'oven', 'food', 'slice'] },
        { icon: 'fa-solid fa-bread-slice', label: 'Bread / Toaster', category: 'kitchen', keywords: ['bread', 'toast', 'toaster', 'breakfast', 'bakery', 'food'] },
        { icon: 'fa-solid fa-cake-candles', label: 'Cake / Bakery', category: 'kitchen', keywords: ['cake', 'baking', 'oven', 'dessert', 'sweet'] },
        { icon: 'fa-solid fa-egg', label: 'Egg / Whisking', category: 'kitchen', keywords: ['egg', 'whisk', 'beat', 'mix', 'cooking', 'food'] },
        { icon: 'fa-solid fa-cheese', label: 'Cheese / Dairy', category: 'kitchen', keywords: ['cheese', 'dairy', 'grater', 'food'] },
        { icon: 'fa-solid fa-apple-whole', label: 'Fruit / Juicer', category: 'kitchen', keywords: ['apple', 'fruit', 'juicer', 'healthy', 'food'] },
        { icon: 'fa-solid fa-carrot', label: 'Vegetable / Chopper', category: 'kitchen', keywords: ['carrot', 'vegetable', 'chopper', 'cutter', 'cook'] },

        // Appliances & Home Equipment
        { icon: 'fa-solid fa-fan', label: 'Fan / Cooling Appliance', category: 'appliances', keywords: ['fan', 'cooler', 'ventilation', 'exhaust', 'ceiling fan', 'table fan', 'air', 'wind', 'cool', 'appliance'] },
        { icon: 'fa-solid fa-plug', label: 'Electric Plug / Appliance', category: 'appliances', keywords: ['plug', 'power', 'electric', 'electronic', 'cord', 'mixer', 'appliance', 'voltage', 'socket'] },
        { icon: 'fa-solid fa-wind', label: 'Wind / Airflow / Chimney', category: 'appliances', keywords: ['wind', 'air', 'chimney', 'blower', 'exhaust', 'ventilation', 'flow', 'fan'] },
        { icon: 'fa-solid fa-smog', label: 'Smoke / Chimney Hood', category: 'appliances', keywords: ['chimney', 'smoke', 'exhaust', 'hood', 'smog', 'kitchen chimney', 'vapor', 'steam'] },
        { icon: 'fa-solid fa-snowflake', label: 'Snowflake / Refrigerator / AC', category: 'appliances', keywords: ['snowflake', 'fridge', 'refrigerator', 'freezer', 'ac', 'cooler', 'cold', 'frost'] },
        { icon: 'fa-solid fa-faucet', label: 'Faucet / Water Purifier', category: 'appliances', keywords: ['faucet', 'tap', 'water purifier', 'ro', 'filter', 'sink', 'plumbing', 'water'] },
        { icon: 'fa-solid fa-faucet-drip', label: 'Faucet Drip / Purifier', category: 'appliances', keywords: ['faucet', 'tap', 'drop', 'leak', 'water purifier', 'geyser', 'filter'] },
        { icon: 'fa-solid fa-droplet', label: 'Water Droplet / RO Purifier', category: 'appliances', keywords: ['water', 'drop', 'purifier', 'filter', 'geyser', 'liquid', 'aqua', 'ro purifier'] },
        { icon: 'fa-solid fa-shower', label: 'Shower / Geyser', category: 'appliances', keywords: ['shower', 'bath', 'geyser', 'water heater', 'hot water', 'bathroom'] },
        { icon: 'fa-solid fa-temperature-high', label: 'High Heat / Geyser / Heater', category: 'appliances', keywords: ['temperature', 'heat', 'heater', 'geyser', 'iron', 'hot', 'thermometer', 'warm'] },
        { icon: 'fa-solid fa-temperature-arrow-up', label: 'Temperature Rise / Heater', category: 'appliances', keywords: ['temperature', 'heater', 'heat', 'warm', 'thermostat'] },
        { icon: 'fa-solid fa-shirt', label: 'Shirt / Iron / Press', category: 'appliances', keywords: ['shirt', 'iron', 'dry iron', 'steam iron', 'press', 'laundry', 'clothes'] },
        { icon: 'fa-solid fa-tv', label: 'Television / Display', category: 'appliances', keywords: ['tv', 'television', 'screen', 'monitor', 'display', 'electronics'] },
        { icon: 'fa-solid fa-lightbulb', label: 'Light Bulb / Lighting', category: 'appliances', keywords: ['bulb', 'light', 'lamp', 'led', 'energy', 'bright', 'idea'] },
        { icon: 'fa-solid fa-bolt', label: 'Power / Electricity', category: 'appliances', keywords: ['bolt', 'electricity', 'lightning', 'energy', 'voltage', 'power', 'fast', 'quick'] },
        { icon: 'fa-solid fa-soap', label: 'Soap / Dishwasher', category: 'appliances', keywords: ['soap', 'clean', 'wash', 'dishwasher', 'hygiene', 'detergent'] },
        { icon: 'fa-solid fa-spray-can-sparkles', label: 'Spray / Cleaning', category: 'appliances', keywords: ['spray', 'cleaning', 'cleaner', 'maintenance', 'sparkle'] },
        { icon: 'fa-solid fa-couch', label: 'Furniture / Home Decor', category: 'appliances', keywords: ['couch', 'sofa', 'furniture', 'home', 'living', 'interior'] },

        // Shopping & Brands / E-Commerce
        { icon: 'fa-solid fa-tag', label: 'Tag / Brand Badge', category: 'brand', keywords: ['tag', 'price', 'label', 'brand', 'offer', 'badge', 'sale', 'ticket'] },
        { icon: 'fa-solid fa-tags', label: 'Tags / Categories / Brands', category: 'brand', keywords: ['tags', 'labels', 'brands', 'categories', 'offers', 'coupons', 'badges'] },
        { icon: 'fa-solid fa-award', label: 'Award / Quality Badge', category: 'brand', keywords: ['award', 'ribbon', 'premium', 'quality', 'certified', 'winner', 'best', 'brand'] },
        { icon: 'fa-solid fa-crown', label: 'Crown / Luxury / Top Tier', category: 'brand', keywords: ['crown', 'king', 'vip', 'premium', 'luxury', 'top brand', 'royal', 'gold'] },
        { icon: 'fa-solid fa-star', label: 'Star / Featured / Rating', category: 'brand', keywords: ['star', 'favorite', 'rating', 'top', 'featured', 'popular', 'best', 'quality'] },
        { icon: 'fa-solid fa-certificate', label: 'Certificate / Certified Quality', category: 'brand', keywords: ['certificate', 'guarantee', 'warranty', 'genuine', 'certified', 'trust', 'verified', 'authentic'] },
        { icon: 'fa-solid fa-medal', label: 'Medal / Gold Standard', category: 'brand', keywords: ['medal', 'gold', 'winner', 'rank', 'brand', 'quality', 'excellence'] },
        { icon: 'fa-solid fa-gem', label: 'Gem / Diamond / Luxury', category: 'brand', keywords: ['gem', 'diamond', 'jewel', 'luxury', 'precious', 'value', 'top tier'] },
        { icon: 'fa-solid fa-shield-halved', label: 'Shield / Warranty / Trust', category: 'brand', keywords: ['shield', 'warranty', 'guarantee', 'protection', 'secure', 'trust', 'safety'] },
        { icon: 'fa-solid fa-bag-shopping', label: 'Shopping Bag', category: 'brand', keywords: ['bag', 'shopping', 'store', 'cart', 'buy', 'retail', 'market'] },
        { icon: 'fa-solid fa-cart-shopping', label: 'Shopping Cart', category: 'brand', keywords: ['cart', 'trolley', 'shopping', 'store', 'ecommerce', 'checkout'] },
        { icon: 'fa-solid fa-basket-shopping', label: 'Shopping Basket', category: 'brand', keywords: ['basket', 'shopping', 'grocery', 'store', 'items'] },
        { icon: 'fa-solid fa-store', label: 'Store / Dealership / Shop', category: 'brand', keywords: ['store', 'shop', 'showroom', 'dealership', 'outlet', 'market'] },
        { icon: 'fa-solid fa-shop', label: 'Shop / Retail', category: 'brand', keywords: ['shop', 'retail', 'boutique', 'merchant'] },
        { icon: 'fa-solid fa-gift', label: 'Gift / Promotion / Offer', category: 'brand', keywords: ['gift', 'box', 'present', 'offer', 'deal', 'promo', 'surprise'] },
        { icon: 'fa-solid fa-percent', label: 'Discount / Offers', category: 'brand', keywords: ['discount', 'percent', 'offer', 'sale', 'promo', 'deal', 'cheap'] },
        { icon: 'fa-solid fa-truck-fast', label: 'Fast Delivery / Shipping', category: 'brand', keywords: ['truck', 'delivery', 'shipping', 'fast', 'express', 'transport'] },
        { icon: 'fa-solid fa-thumbs-up', label: 'Thumbs Up / Recommended', category: 'brand', keywords: ['like', 'thumbs up', 'good', 'approved', 'positive', 'popular'] },
        { icon: 'fa-solid fa-heart', label: 'Heart / Loved Products', category: 'brand', keywords: ['heart', 'love', 'wishlist', 'favorite', 'care'] },

        // Gallery & Media
        { icon: 'fa-solid fa-camera', label: 'Camera / Photography', category: 'media', keywords: ['camera', 'photo', 'picture', 'photography', 'shoot', 'image'] },
        { icon: 'fa-solid fa-camera-retro', label: 'Retro Camera / Showcase', category: 'media', keywords: ['camera', 'retro', 'events', 'gallery', 'showcase', 'exhibition', 'vintage'] },
        { icon: 'fa-solid fa-images', label: 'Gallery / Multiple Photos', category: 'media', keywords: ['images', 'photos', 'pictures', 'gallery', 'album', 'collection'] },
        { icon: 'fa-solid fa-image', label: 'Image / Single Photo', category: 'media', keywords: ['image', 'photo', 'picture', 'frame', 'scenery'] },
        { icon: 'fa-solid fa-video', label: 'Video / Demo Recording', category: 'media', keywords: ['video', 'camera', 'recording', 'film', 'movie', 'demo', 'clip'] },
        { icon: 'fa-solid fa-film', label: 'Film / Showcase Reel', category: 'media', keywords: ['film', 'movie', 'reel', 'cinema', 'video', 'showcase'] },
        { icon: 'fa-solid fa-clapperboard', label: 'Clapperboard / Media Shoot', category: 'media', keywords: ['clapperboard', 'production', 'media', 'commercial', 'shoot'] },
        { icon: 'fa-solid fa-photo-film', label: 'Photo & Film Gallery', category: 'media', keywords: ['photo', 'film', 'multimedia', 'gallery', 'album'] },
        { icon: 'fa-solid fa-eye', label: 'Eye / View / Preview', category: 'media', keywords: ['eye', 'view', 'look', 'preview', 'watch', 'vision'] },

        // Tools & Mechanical & Hardware
        { icon: 'fa-solid fa-gear', label: 'Gear / Motor / Mechanism', category: 'tools', keywords: ['gear', 'cog', 'motor', 'engine', 'mechanism', 'machinery', 'mixer motor', 'parts', 'setting'] },
        { icon: 'fa-solid fa-gears', label: 'Gears / Technology', category: 'tools', keywords: ['gears', 'mechanism', 'machinery', 'automation', 'engineering'] },
        { icon: 'fa-solid fa-wrench', label: 'Wrench / Service / Repair', category: 'tools', keywords: ['wrench', 'spanner', 'service', 'repair', 'maintenance', 'fix', 'tool'] },
        { icon: 'fa-solid fa-screwdriver-wrench', label: 'Tools / Installation', category: 'tools', keywords: ['tools', 'screwdriver', 'wrench', 'hardware', 'repair', 'installation', 'assembly'] },
        { icon: 'fa-solid fa-hammer', label: 'Hammer / Hardware', category: 'tools', keywords: ['hammer', 'build', 'construction', 'hardware', 'tool'] },
        { icon: 'fa-solid fa-screwdriver', label: 'Screwdriver / Repair', category: 'tools', keywords: ['screwdriver', 'tool', 'fix', 'hardware'] },
        { icon: 'fa-solid fa-gas-pump', label: 'Gas Pump / LPG / Fuel', category: 'tools', keywords: ['gas', 'fuel', 'lpg', 'cylinder', 'gas pipe', 'pump', 'energy'] },

        // General & Taxonomy
        { icon: 'fa-solid fa-box', label: 'Box / Package', category: 'general', keywords: ['box', 'package', 'parcel', 'carton', 'product', 'item'] },
        { icon: 'fa-solid fa-box-open', label: 'Box Open / Products', category: 'general', keywords: ['box', 'box open', 'product category', 'unboxing', 'package', 'inventory'] },
        { icon: 'fa-solid fa-boxes-stacked', label: 'Boxes Stacked / Inventory', category: 'general', keywords: ['boxes', 'stacked', 'warehouse', 'stock', 'inventory', 'storage'] },
        { icon: 'fa-solid fa-cubes', label: 'Cubes / Modular', category: 'general', keywords: ['cubes', 'blocks', 'modules', 'components', 'items'] },
        { icon: 'fa-solid fa-layer-group', label: 'Layer Group / Category', category: 'general', keywords: ['layer', 'group', 'stack', 'category', 'collection', 'hierarchy'] },
        { icon: 'fa-solid fa-circle-check', label: 'Check / Verified', category: 'general', keywords: ['check', 'tick', 'approved', 'valid', 'success', 'verified'] },
        { icon: 'fa-solid fa-sparkles', label: 'Sparkles / New / Premium', category: 'general', keywords: ['sparkles', 'new', 'shine', 'clean', 'magic', 'special', 'featured'] },
        { icon: 'fa-solid fa-house', label: 'House / Home Domestic', category: 'general', keywords: ['house', 'home', 'living', 'domestic', 'household'] },
        { icon: 'fa-solid fa-building', label: 'Building / Corporate', category: 'general', keywords: ['building', 'company', 'office', 'corporate', 'enterprise', 'factory'] },
        { icon: 'fa-solid fa-warehouse', label: 'Warehouse / Depot', category: 'general', keywords: ['warehouse', 'storage', 'distribution', 'depot', 'hub'] },
        { icon: 'fa-solid fa-clock', label: 'Clock / Time', category: 'general', keywords: ['clock', 'time', 'timer', 'hour', 'fast'] },

        // Brand Logos
        { icon: 'fa-brands fa-mix', label: 'Mix Logo (Brand)', category: 'brand', keywords: ['mix', 'mixer', 'brand', 'mix.com', 'logo'] },
        { icon: 'fa-brands fa-amazon', label: 'Amazon', category: 'brand', keywords: ['amazon', 'brand', 'ecommerce', 'online'] },
        { icon: 'fa-brands fa-whatsapp', label: 'WhatsApp', category: 'brand', keywords: ['whatsapp', 'chat', 'contact', 'support'] },
        { icon: 'fa-brands fa-google', label: 'Google', category: 'brand', keywords: ['google', 'search', 'brand'] },
        { icon: 'fa-brands fa-facebook', label: 'Facebook', category: 'brand', keywords: ['facebook', 'social', 'media'] },
        { icon: 'fa-brands fa-instagram', label: 'Instagram', category: 'brand', keywords: ['instagram', 'social', 'media', 'photos'] },
        { icon: 'fa-brands fa-youtube', label: 'YouTube', category: 'brand', keywords: ['youtube', 'video', 'channel', 'media'] }
    ];

    // Synonyms & Intent Mapping for terms that do NOT have a direct FA icon
    const SYNONYMS_MAP = {
        'mixer': ['fa-solid fa-blender', 'fa-solid fa-blender-phone', 'fa-solid fa-kitchen-set', 'fa-solid fa-fire-burner', 'fa-solid fa-utensils', 'fa-solid fa-plug', 'fa-solid fa-gear', 'fa-brands fa-mix'],
        'mix': ['fa-solid fa-blender', 'fa-brands fa-mix', 'fa-solid fa-kitchen-set'],
        'grinder': ['fa-solid fa-blender', 'fa-solid fa-kitchen-set', 'fa-solid fa-gear', 'fa-solid fa-bowl-food'],
        'mixer grinder': ['fa-solid fa-blender', 'fa-solid fa-kitchen-set', 'fa-solid fa-plug'],
        'blender': ['fa-solid fa-blender', 'fa-solid fa-blender-phone', 'fa-solid fa-kitchen-set'],
        'juicer': ['fa-solid fa-blender', 'fa-solid fa-apple-whole', 'fa-solid fa-kitchen-set'],
        'food processor': ['fa-solid fa-blender', 'fa-solid fa-kitchen-set', 'fa-solid fa-gear'],
        'stove': ['fa-solid fa-fire-burner', 'fa-solid fa-fire', 'fa-solid fa-kitchen-set', 'fa-solid fa-temperature-high'],
        'gas stove': ['fa-solid fa-fire-burner', 'fa-solid fa-fire', 'fa-solid fa-kitchen-set'],
        'gas': ['fa-solid fa-fire-burner', 'fa-solid fa-fire', 'fa-solid fa-gas-pump', 'fa-solid fa-kitchen-set'],
        'burner': ['fa-solid fa-fire-burner', 'fa-solid fa-fire', 'fa-solid fa-kitchen-set'],
        'cooker': ['fa-solid fa-fire-burner', 'fa-solid fa-bowl-rice', 'fa-solid fa-kitchen-set', 'fa-solid fa-fire'],
        'pressure cooker': ['fa-solid fa-bowl-rice', 'fa-solid fa-fire-burner', 'fa-solid fa-kitchen-set'],
        'cooktop': ['fa-solid fa-fire-burner', 'fa-solid fa-kitchen-set', 'fa-solid fa-fire'],
        'chulha': ['fa-solid fa-fire-burner', 'fa-solid fa-fire'],
        'oven': ['fa-solid fa-kitchen-set', 'fa-solid fa-fire-burner', 'fa-solid fa-bread-slice', 'fa-solid fa-fire'],
        'kitchen': ['fa-solid fa-kitchen-set', 'fa-solid fa-fire-burner', 'fa-solid fa-utensils', 'fa-solid fa-blender', 'fa-solid fa-bowl-food'],
        'appliance': ['fa-solid fa-kitchen-set', 'fa-solid fa-plug', 'fa-solid fa-blender', 'fa-solid fa-fire-burner', 'fa-solid fa-fan'],
        'appliances': ['fa-solid fa-kitchen-set', 'fa-solid fa-plug', 'fa-solid fa-blender', 'fa-solid fa-fan'],
        'chimney': ['fa-solid fa-smog', 'fa-solid fa-wind', 'fa-solid fa-fan', 'fa-solid fa-fire'],
        'geyser': ['fa-solid fa-temperature-high', 'fa-solid fa-shower', 'fa-solid fa-fire', 'fa-solid fa-droplet'],
        'water heater': ['fa-solid fa-temperature-high', 'fa-solid fa-shower', 'fa-solid fa-droplet'],
        'purifier': ['fa-solid fa-droplet', 'fa-solid fa-faucet', 'fa-solid fa-faucet-drip', 'fa-solid fa-bottle-water'],
        'water purifier': ['fa-solid fa-droplet', 'fa-solid fa-faucet', 'fa-solid fa-faucet-drip'],
        'ro': ['fa-solid fa-droplet', 'fa-solid fa-faucet'],
        'filter': ['fa-solid fa-droplet', 'fa-solid fa-faucet'],
        'iron': ['fa-solid fa-shirt', 'fa-solid fa-bolt', 'fa-solid fa-temperature-high'],
        'press': ['fa-solid fa-shirt', 'fa-solid fa-bolt'],
        'fan': ['fa-solid fa-fan', 'fa-solid fa-wind', 'fa-solid fa-snowflake'],
        'cooler': ['fa-solid fa-snowflake', 'fa-solid fa-fan', 'fa-solid fa-wind'],
        'ac': ['fa-solid fa-snowflake', 'fa-solid fa-fan', 'fa-solid fa-wind'],
        'air conditioner': ['fa-solid fa-snowflake', 'fa-solid fa-fan'],
        'fridge': ['fa-solid fa-snowflake', 'fa-solid fa-kitchen-set'],
        'refrigerator': ['fa-solid fa-snowflake', 'fa-solid fa-kitchen-set'],
        'tv': ['fa-solid fa-tv', 'fa-solid fa-plug', 'fa-solid fa-bolt'],
        'television': ['fa-solid fa-tv', 'fa-solid fa-plug'],
        'brand': ['fa-solid fa-tag', 'fa-solid fa-tags', 'fa-solid fa-award', 'fa-solid fa-crown', 'fa-solid fa-star'],
        'brands': ['fa-solid fa-tags', 'fa-solid fa-tag', 'fa-solid fa-award'],
        'gallery': ['fa-solid fa-images', 'fa-solid fa-camera', 'fa-solid fa-camera-retro', 'fa-solid fa-image'],
        'events': ['fa-solid fa-camera-retro', 'fa-solid fa-images', 'fa-solid fa-calendar-days'],
        'dealership': ['fa-solid fa-store', 'fa-solid fa-shop', 'fa-solid fa-building'],
        'utensil': ['fa-solid fa-utensils', 'fa-solid fa-spoon', 'fa-solid fa-plate-wheat'],
        'crockery': ['fa-solid fa-plate-wheat', 'fa-solid fa-utensils', 'fa-solid fa-bowl-food'],
        'pot': ['fa-solid fa-kitchen-set', 'fa-solid fa-fire-burner', 'fa-solid fa-bowl-food'],
        'pan': ['fa-solid fa-kitchen-set', 'fa-solid fa-fire-burner', 'fa-solid fa-utensils']
    };

    /**
     * Clean and normalize raw Font Awesome class string or HTML tag
     * e.g. '<i class="fa-brands fa-mix"></i>' -> 'fa-brands fa-mix'
     * e.g. 'fa-fire' -> 'fa-solid fa-fire'
     */
    function cleanFaClass(raw) {
        if (!raw) return '';
        raw = raw.trim();

        // If user pasted HTML tag like <i class="..."></i>
        const classMatch = raw.match(/class=["']([^"']+)["']/i);
        if (classMatch && classMatch[1]) {
            raw = classMatch[1];
        }

        // Strip HTML tags if any
        raw = raw.replace(/<\/?[^>]+(>|$)/g, '').trim();
        if (!raw) return '';

        // Tokenize
        const tokens = raw.split(/\s+/).filter(Boolean);
        let prefix = '';
        let iconName = '';

        tokens.forEach(t => {
            const tl = t.toLowerCase();
            if (['fa-solid', 'fas'].includes(tl)) {
                prefix = 'fa-solid';
            } else if (['fa-regular', 'far'].includes(tl)) {
                prefix = 'fa-regular';
            } else if (['fa-brands', 'fab'].includes(tl)) {
                prefix = 'fa-brands';
            } else if (['fa-light', 'fal', 'fa-thin', 'fat', 'fa-duotone', 'fad'].includes(tl)) {
                prefix = tl;
            } else if (tl.startsWith('fa-')) {
                iconName = tl;
            } else if (tl !== 'fa') {
                iconName = 'fa-' + tl;
            }
        });

        if (!iconName) {
            return '';
        }

        // If icon is a known brand icon, default prefix to fa-brands
        if (!prefix) {
            const knownBrand = FA_ICONS.find(item => item.icon.startsWith('fa-brands ') && item.icon.endsWith(iconName));
            prefix = knownBrand ? 'fa-brands' : 'fa-solid';
        }

        return `${prefix} ${iconName}`;
    }

    /**
     * Calculate Levenshtein distance for typo tolerance
     */
    function levenshtein(a, b) {
        const matrix = [];
        for (let i = 0; i <= b.length; i++) matrix[i] = [i];
        for (let j = 0; j <= a.length; j++) matrix[0][j] = j;

        for (let i = 1; i <= b.length; i++) {
            for (let j = 1; j <= a.length; j++) {
                if (b.charAt(i - 1) === a.charAt(j - 1)) {
                    matrix[i][j] = matrix[i - 1][j - 1];
                } else {
                    matrix[i][j] = Math.min(
                        matrix[i - 1][j - 1] + 1,
                        matrix[i][j - 1] + 1,
                        matrix[i - 1][j] + 1
                    );
                }
            }
        }
        return matrix[b.length][a.length];
    }

    /**
     * Search icon database & synonyms with typo handling
     */
    function searchIcons(query) {
        if (!query) return { exactMatches: [], recommendations: [], isDirectValid: false, cleanQuery: '' };

        // Clean user input
        let q = query.trim().toLowerCase();
        // Remove HTML if pasted
        const classMatch = q.match(/class=["']([^"']+)["']/i);
        if (classMatch && classMatch[1]) {
            q = classMatch[1].toLowerCase();
        }
        q = q.replace(/<\/?[^>]+(>|$)/g, '').trim();

        // Remove fa-solid, fa-, etc., for semantic matching
        let cleanWord = q.replace(/^(fa-solid|fa-brands|fa-regular|fas|fab|far|fa)\s+/, '')
                         .replace(/^fa-/, '')
                         .trim();

        // 1. Check if typed value is an exact valid icon in our catalog
        const directValid = FA_ICONS.find(item => {
            const itemClean = item.icon.replace(/^(fa-solid|fa-brands|fa-regular)\s+fa-/, '');
            const itemClass = item.icon;
            return itemClass === q || itemClean === cleanWord || item.icon.endsWith('fa-' + cleanWord);
        });

        // 2. Exact or partial keyword matches
        const exactMatches = FA_ICONS.filter(item => {
            const itemClean = item.icon.replace(/^(fa-solid|fa-brands|fa-regular)\s+fa-/, '');
            return itemClean.includes(cleanWord) || 
                   item.label.toLowerCase().includes(cleanWord) ||
                   item.keywords.some(k => k === cleanWord || k.includes(cleanWord));
        });

        // 3. Synonym matches
        let synonymIcons = [];
        if (SYNONYMS_MAP[cleanWord]) {
            synonymIcons = SYNONYMS_MAP[cleanWord];
        } else {
            // Check partial synonym key matches
            for (const [synKey, iconList] of Object.entries(SYNONYMS_MAP)) {
                if (cleanWord.includes(synKey) || synKey.includes(cleanWord) || levenshtein(cleanWord, synKey) <= 2) {
                    synonymIcons = synonymIcons.concat(iconList);
                }
            }
        }

        // Deduplicate synonym icons and fetch objects
        const recObjects = [];
        const seen = new Set();

        synonymIcons.forEach(iconStr => {
            if (!seen.has(iconStr)) {
                seen.add(iconStr);
                const found = FA_ICONS.find(item => item.icon === iconStr);
                if (found) {
                    recObjects.push(found);
                } else {
                    recObjects.push({ icon: iconStr, label: iconStr.replace(/^(fa-solid|fa-brands)\s+fa-/, ''), category: 'kitchen', keywords: [] });
                }
            }
        });

        // Also add fuzzy matches if we have few recommendations
        if (exactMatches.length === 0 && recObjects.length === 0) {
            FA_ICONS.forEach(item => {
                const itemClean = item.icon.replace(/^(fa-solid|fa-brands|fa-regular)\s+fa-/, '');
                if (levenshtein(cleanWord, itemClean) <= 2 && !seen.has(item.icon)) {
                    seen.add(item.icon);
                    recObjects.push(item);
                }
            });
        }

        return {
            exactMatches: exactMatches.slice(0, 10),
            recommendations: recObjects.slice(0, 8),
            isDirectValid: !!directValid,
            directValidIcon: directValid ? directValid.icon : null,
            cleanQuery: cleanWord
        };
    }

    /**
     * Global Icon Picker Manager
     */
    let activeInputForModal = null;
    let browseModalInstance = null;

    /**
     * Initialize all widgets on the page
     */
    function initIconWidgets() {
        document.querySelectorAll('.icon-picker-widget').forEach(widget => {
            setupWidget(widget);
        });

        setupBrowseModal();
    }

    function setupWidget(widget) {
        const input = widget.querySelector('.icon-picker-input');
        const previewBox = widget.querySelector('.icon-preview-box');
        const previewIcon = previewBox ? previewBox.querySelector('i') : null;
        const suggestionsPanel = widget.querySelector('.icon-suggestions-panel');
        const btnBrowse = widget.querySelector('.btn-browse-icons');
        const btnClear = widget.querySelector('.btn-clear-icon');
        const quickChips = widget.querySelectorAll('.btn-quick-icon');

        if (!input) return;

        // Function to update preview icon
        function updatePreview(val) {
            const cleaned = cleanFaClass(val);
            if (cleaned) {
                if (previewIcon) {
                    previewIcon.className = cleaned;
                }
                if (previewBox) {
                    previewBox.classList.add('is-valid-icon');
                    previewBox.classList.remove('is-invalid-icon');
                    previewBox.title = 'Active: ' + cleaned;
                }
                if (btnClear) btnClear.classList.remove('d-none');
            } else {
                if (previewIcon) {
                    previewIcon.className = 'fa-solid fa-icons';
                }
                if (previewBox) {
                    previewBox.classList.remove('is-valid-icon', 'is-invalid-icon');
                    previewBox.title = 'No icon selected';
                }
                if (btnClear) btnClear.classList.add('d-none');
            }
        }

        // Initialize preview on page load
        updatePreview(input.value);

        // When user types or pastes into input
        input.addEventListener('input', function() {
            const raw = this.value;

            // Auto-clean if user pasted full HTML tag e.g. <i class="..."></i>
            if (raw.includes('<') && raw.includes('>')) {
                const cleaned = cleanFaClass(raw);
                if (cleaned) {
                    this.value = cleaned;
                }
            }

            const currentVal = this.value.trim();
            updatePreview(currentVal);

            if (!currentVal) {
                if (suggestionsPanel) {
                    suggestionsPanel.innerHTML = '';
                    suggestionsPanel.classList.add('d-none');
                }
                return;
            }

            renderSuggestions(currentVal, suggestionsPanel, input, updatePreview);
        });

        // Focus event: show suggestions if value exists or popular if empty
        input.addEventListener('focus', function() {
            const currentVal = this.value.trim();
            if (currentVal && suggestionsPanel) {
                renderSuggestions(currentVal, suggestionsPanel, input, updatePreview);
            }
        });

        // Clear button click
        if (btnClear) {
            btnClear.addEventListener('click', function(e) {
                e.preventDefault();
                input.value = '';
                updatePreview('');
                if (suggestionsPanel) {
                    suggestionsPanel.innerHTML = '';
                    suggestionsPanel.classList.add('d-none');
                }
                input.focus();
            });
        }

        // Browse modal button click
        if (btnBrowse) {
            btnBrowse.addEventListener('click', function(e) {
                e.preventDefault();
                openBrowseModal(input, updatePreview);
            });
        }

        // Quick Pick Chips
        quickChips.forEach(chip => {
            chip.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.getAttribute('data-icon');
                if (icon) {
                    input.value = icon;
                    updatePreview(icon);
                    if (suggestionsPanel) {
                        suggestionsPanel.innerHTML = '';
                        suggestionsPanel.classList.add('d-none');
                    }
                    showSelectedToast(widget, icon);
                }
            });
        });

        // Close suggestions dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!widget.contains(e.target)) {
                if (suggestionsPanel) {
                    suggestionsPanel.classList.add('d-none');
                }
            }
        });
    }

    /**
     * Render Suggestions Dropdown
     */
    function renderSuggestions(query, panel, input, updatePreviewCallback) {
        if (!panel) return;

        const results = searchIcons(query);
        const { exactMatches, recommendations, isDirectValid, cleanQuery } = results;

        // If direct match found with no ambiguity and user typed the full valid class
        if (isDirectValid && exactMatches.length === 1 && exactMatches[0].icon === query.trim()) {
            panel.innerHTML = `
                <div class="p-2 text-success small d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><strong>${escapeHtml(query)}</strong> is a valid Font Awesome icon.</span>
                </div>
            `;
            panel.classList.remove('d-none');
            return;
        }

        let html = '';

        // CASE 1: Query is NOT a valid Font Awesome icon (like "mixer")
        if (!isDirectValid && recommendations.length > 0) {
            html += `
                <div class="icon-suggestion-warning p-2 px-3 border-bottom bg-warning-subtle">
                    <div class="d-flex align-items-center gap-2 text-warning-emphasis fw-semibold small">
                        <i class="fa-solid fa-triangle-exclamation text-warning fa-lg"></i>
                        <span>"${escapeHtml(query)}" is not a direct Font Awesome icon name.</span>
                    </div>
                    <div class="text-muted small mt-1" style="font-size: 0.78rem;">
                        Font Awesome has no <code>fa-${escapeHtml(cleanQuery)}</code>. Select one of the similar recommended icons below:
                    </div>
                </div>
                <div class="p-2 bg-light border-bottom text-muted fw-bold small text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                    <i class="fa-solid fa-lightbulb text-warning me-1"></i> Recommended Similar Icons
                </div>
                <div class="icon-suggestions-list">
            `;

            recommendations.forEach((item, idx) => {
                const isTopPick = idx === 0;
                html += `
                    <div class="icon-suggestion-item ${isTopPick ? 'top-pick' : ''}" data-icon="${escapeHtml(item.icon)}">
                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                            <div class="item-icon-box">
                                <i class="${escapeHtml(item.icon)}"></i>
                            </div>
                            <div>
                                <div class="item-name fw-semibold">${escapeHtml(item.icon)}</div>
                                <div class="item-desc text-muted small">${escapeHtml(item.label)}</div>
                            </div>
                        </div>
                        ${isTopPick ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 small">★ Best Match</span>' : ''}
                    </div>
                `;
            });

            html += `</div>`;
        }

        // CASE 2: Matches found by keyword / name
        if (exactMatches.length > 0) {
            if (recommendations.length > 0 && !isDirectValid) {
                html += `
                    <div class="p-2 bg-light border-bottom text-muted fw-bold small text-uppercase mt-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Related Icons
                    </div>
                `;
            }
            html += `<div class="icon-suggestions-list">`;
            exactMatches.forEach(item => {
                // Avoid duplicating if already shown in recommendations
                if (recommendations.some(r => r.icon === item.icon)) return;

                html += `
                    <div class="icon-suggestion-item" data-icon="${escapeHtml(item.icon)}">
                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                            <div class="item-icon-box">
                                <i class="${escapeHtml(item.icon)}"></i>
                            </div>
                            <div>
                                <div class="item-name fw-semibold">${escapeHtml(item.icon)}</div>
                                <div class="item-desc text-muted small">${escapeHtml(item.label)}</div>
                            </div>
                        </div>
                        <span class="badge bg-light text-muted border small text-capitalize">${escapeHtml(item.category)}</span>
                    </div>
                `;
            });
            html += `</div>`;
        }

        // CASE 3: Completely unknown with no matches or recommendations
        if (!html) {
            html = `
                <div class="p-3 text-center text-muted small">
                    <i class="fa-solid fa-circle-question fa-2x mb-2 text-secondary opacity-50 d-block"></i>
                    <div>No direct match for <strong>"${escapeHtml(query)}"</strong>.</div>
                    <div class="mt-1">Try searching for keywords like <code>blender</code>, <code>stove</code>, <code>fire</code>, <code>kitchen</code>, or click <strong>Browse</strong>.</div>
                </div>
            `;
        }

        panel.innerHTML = html;
        panel.classList.remove('d-none');

        // Attach click handlers to all suggestion items
        panel.querySelectorAll('.icon-suggestion-item').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedIcon = this.getAttribute('data-icon');
                if (selectedIcon) {
                    input.value = selectedIcon;
                    updatePreviewCallback(selectedIcon);
                    panel.innerHTML = '';
                    panel.classList.add('d-none');
                    showSelectedToast(input.closest('.icon-picker-widget'), selectedIcon);
                }
            });
        });
    }

    /**
     * Show a subtle temporary confirmation pill
     */
    function showSelectedToast(widget, icon) {
        if (!widget) return;
        let badge = widget.querySelector('.icon-selected-badge');
        if (!badge) {
            badge = document.createElement('div');
            badge.className = 'icon-selected-badge mt-2 text-success small d-flex align-items-center gap-1';
            widget.appendChild(badge);
        }
        badge.innerHTML = `<i class="fa-solid fa-circle-check"></i> <span>Selected <code>${escapeHtml(icon)}</code></span>`;
        badge.style.display = 'flex';
        setTimeout(() => {
            if (badge) badge.style.display = 'none';
        }, 3000);
    }

    /**
     * Setup Browse Icons Modal
     */
    function setupBrowseModal() {
        if (document.getElementById('faIconPickerModal')) return;

        const modalHtml = `
            <div class="modal fade" id="faIconPickerModal" tabindex="-1" aria-labelledby="faIconPickerModalLabel" aria-hidden="true" style="z-index: 1070;">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
                        <div class="modal-header border-bottom py-3 px-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-danger-subtle text-danger rounded p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="fa-solid fa-icons"></i>
                                </div>
                                <div>
                                    <h5 class="modal-title fw-bold text-dark mb-0" id="faIconPickerModalLabel">Font Awesome Icon Library</h5>
                                    <small class="text-muted">Click any icon to instantly select it for your category</small>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Search & Filter Bar -->
                            <div class="mb-3">
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="modalIconSearchInput" placeholder="Search by name, appliance, or keyword (e.g. mixer, stove, fan, tag)..." autocomplete="off">
                                    <button class="btn btn-outline-secondary" type="button" id="modalIconSearchClear"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <!-- Category Filter Pills -->
                                <div class="d-flex flex-wrap gap-1 mt-2" id="modalCategoryFilterPills">
                                    <button type="button" class="btn btn-sm btn-danger active" data-cat="all">All Icons (<span id="modalIconCount">${FA_ICONS.length}</span>)</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="kitchen"><i class="fa-solid fa-kitchen-set me-1"></i> Kitchen & Cooking</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="appliances"><i class="fa-solid fa-plug me-1"></i> Appliances & Home</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="brand"><i class="fa-solid fa-tags me-1"></i> Brands & Commerce</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="media"><i class="fa-solid fa-camera-retro me-1"></i> Gallery & Media</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="tools"><i class="fa-solid fa-wrench me-1"></i> Tools</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-cat="general"><i class="fa-solid fa-box-open me-1"></i> General</button>
                                </div>
                            </div>

                            <!-- Icons Grid Container -->
                            <div class="icon-grid-container" id="modalIconGrid">
                                <!-- Populated dynamically -->
                            </div>
                        </div>
                        <div class="modal-footer bg-light border-top py-2 px-4 justify-content-between">
                            <span class="text-muted small">Tip: Can't find an icon? Type your keyword in the category form for automatic smart suggestions!</span>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        const modalEl = document.getElementById('faIconPickerModal');
        browseModalInstance = new bootstrap.Modal(modalEl);

        const searchInput = document.getElementById('modalIconSearchInput');
        const clearBtn = document.getElementById('modalIconSearchClear');
        const grid = document.getElementById('modalIconGrid');
        const filterPills = document.querySelectorAll('#modalCategoryFilterPills button');

        let currentCategory = 'all';

        function renderGrid(searchTerm = '', category = 'all') {
            grid.innerHTML = '';
            let filtered = FA_ICONS;

            if (category !== 'all') {
                filtered = filtered.filter(item => item.category === category);
            }

            if (searchTerm) {
                const s = searchTerm.toLowerCase().trim();
                // Check synonyms too
                let synIcons = [];
                if (SYNONYMS_MAP[s]) {
                    synIcons = SYNONYMS_MAP[s];
                }

                filtered = filtered.filter(item => {
                    return item.icon.toLowerCase().includes(s) ||
                           item.label.toLowerCase().includes(s) ||
                           item.keywords.some(k => k.includes(s)) ||
                           synIcons.includes(item.icon);
                });
            }

            if (filtered.length === 0) {
                grid.innerHTML = `
                    <div class="col-12 py-5 text-center text-muted">
                        <i class="fa-solid fa-face-frown fa-2x mb-2 opacity-50 d-block"></i>
                        No icons matched "<strong>${escapeHtml(searchTerm)}</strong>".
                    </div>
                `;
                return;
            }

            filtered.forEach(item => {
                const card = document.createElement('div');
                card.className = 'icon-browser-card';
                card.setAttribute('data-icon', item.icon);
                card.title = `${item.label} (${item.icon})`;
                card.innerHTML = `
                    <div class="card-icon"><i class="${escapeHtml(item.icon)}"></i></div>
                    <div class="card-title text-truncate">${escapeHtml(item.label)}</div>
                    <div class="card-code text-truncate">${escapeHtml(item.icon)}</div>
                `;

                card.addEventListener('click', function() {
                    if (activeInputForModal) {
                        activeInputForModal.value = item.icon;
                        activeInputForModal.dispatchEvent(new Event('input'));
                    }
                    browseModalInstance.hide();
                });

                grid.appendChild(card);
            });
        }

        searchInput.addEventListener('input', function() {
            renderGrid(this.value, currentCategory);
        });

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            renderGrid('', currentCategory);
            searchInput.focus();
        });

        filterPills.forEach(pill => {
            pill.addEventListener('click', function() {
                filterPills.forEach(p => {
                    p.classList.remove('btn-danger', 'active');
                    p.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-danger', 'active');
                currentCategory = this.getAttribute('data-cat');
                renderGrid(searchInput.value, currentCategory);
            });
        });

        // Expose render function for when modal opens
        modalEl._renderGrid = renderGrid;
    }

    function openBrowseModal(input, updatePreviewCallback) {
        activeInputForModal = input;
        const modalEl = document.getElementById('faIconPickerModal');
        if (modalEl && modalEl._renderGrid) {
            const searchInput = document.getElementById('modalIconSearchInput');
            if (searchInput) searchInput.value = '';
            modalEl._renderGrid('', 'all');
        }
        if (browseModalInstance) {
            browseModalInstance.show();
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Expose globally
    window.NandaniIconPicker = {
        init: initIconWidgets,
        cleanFaClass: cleanFaClass,
        searchIcons: searchIcons
    };

    // Auto initialize on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', initIconWidgets);
})();
