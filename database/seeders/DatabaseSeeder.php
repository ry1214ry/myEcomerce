<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User (created via AdminUserSeeder using ADMIN_* env vars)
        $this->call(AdminUserSeeder::class);

        // ── Customer User ───────────────────────────────────────────────
        User::create([
            'name'     => 'John Customer',
            'email'    => 'customer@luxeshop.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
            'phone'    => '+1 234 567 8900',
            'address'  => '123 Main Street',
            'city'     => 'New York',
            'state'    => 'NY',
            'zip_code' => '10001',
            'country'  => 'USA',
        ]);

        // ── Categories (with real picsum images) ────────────────────────
        $categories = [
            [
                'name'        => 'Electronics',
                'slug'        => 'electronics',
                'description' => 'Latest electronic gadgets and devices',
                'image'       => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'name'        => 'Fashion',
                'slug'        => 'fashion',
                'description' => 'Trendy clothing and accessories',
                'image'       => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'name'        => 'Home & Living',
                'slug'        => 'home-living',
                'description' => 'Beautiful home decor and furniture',
                'image'       => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'name'        => 'Sports',
                'slug'        => 'sports',
                'description' => 'Sports equipment and activewear',
                'image'       => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'name'        => 'Beauty',
                'slug'        => 'beauty',
                'description' => 'Premium beauty and skincare products',
                'image'       => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 5,
            ],
            [
                'name'        => 'Books',
                'slug'        => 'books',
                'description' => 'Best books and educational materials',
                'image'       => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=300&fit=crop',
                'is_active'   => true,
                'sort_order'  => 6,
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // ── Brands ──────────────────────────────────────────────────────
        $brands = [
            ['name' => 'Apple',   'slug' => 'apple',   'is_active' => true],
            ['name' => 'Samsung', 'slug' => 'samsung', 'is_active' => true],
            ['name' => 'Nike',    'slug' => 'nike',    'is_active' => true],
            ['name' => 'Adidas',  'slug' => 'adidas',  'is_active' => true],
            ['name' => 'Sony',    'slug' => 'sony',    'is_active' => true],
            ['name' => 'LG',      'slug' => 'lg',      'is_active' => true],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // ── Products (with real Unsplash images) ────────────────────────
        $products = [
            [
                'category_id'       => 1,
                'brand_id'          => 1,
                'name'              => 'iPhone 15 Pro Max',
                'slug'              => 'iphone-15-pro-max',
                'short_description' => 'The most powerful iPhone ever with titanium design.',
                'description'       => 'Experience the future with iPhone 15 Pro Max featuring A17 Pro chip, ProRAW camera system, and USB-C connectivity. The titanium design makes it the lightest Pro Max ever, while the Action button gives you instant access to your favorite features.',
                'price'             => 1299.99,
                'sale_price'        => 1199.99,
                'stock_quantity'    => 50,
                'sku'               => 'IPH15PM001',
                'main_image'        => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.8,
                'reviews_count'     => 124,
            ],
            [
                'category_id'       => 1,
                'brand_id'          => 2,
                'name'              => 'Samsung Galaxy S24 Ultra',
                'slug'              => 'samsung-galaxy-s24-ultra',
                'short_description' => 'The ultimate Galaxy experience with AI features.',
                'description'       => 'Samsung Galaxy S24 Ultra with 200MP camera, S Pen, and Galaxy AI. The most powerful Galaxy ever with a built-in S Pen and titanium frame.',
                'price'             => 1199.99,
                'sale_price'        => null,
                'stock_quantity'    => 35,
                'sku'               => 'SGS24U001',
                'main_image'        => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => false,
                'is_best_seller'    => true,
                'rating'            => 4.7,
                'reviews_count'     => 98,
            ],
            [
                'category_id'       => 3,
                'brand_id'          => null,
                'name'              => 'Luxury Velvet Sofa',
                'slug'              => 'luxury-velvet-sofa',
                'short_description' => 'Premium 3-seater velvet sofa for modern living.',
                'description'       => 'Handcrafted luxury velvet sofa with solid wood frame and premium foam cushions. Available in multiple colors to suit any interior design.',
                'price'             => 899.99,
                'sale_price'        => 749.99,
                'stock_quantity'    => 15,
                'sku'               => 'SOF001',
                'main_image'        => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.6,
                'reviews_count'     => 43,
            ],
            [
                'category_id'       => 4,
                'brand_id'          => 3,
                'name'              => 'Nike Air Max 270',
                'slug'              => 'nike-air-max-270',
                'short_description' => 'Maximum air cushioning for all-day comfort.',
                'description'       => 'Nike Air Max 270 with large Air unit for maximum comfort and street-ready style. Lightweight mesh upper for breathability.',
                'price'             => 150.00,
                'sale_price'        => 119.99,
                'stock_quantity'    => 100,
                'sku'               => 'NAM270001',
                'main_image'        => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => false,
                'is_new_arrival'    => true,
                'is_best_seller'    => true,
                'rating'            => 4.5,
                'reviews_count'     => 215,
            ],
            [
                'category_id'       => 2,
                'brand_id'          => 4,
                'name'              => 'Adidas Ultraboost 23',
                'slug'              => 'adidas-ultraboost-23',
                'short_description' => 'Energy-returning running shoes.',
                'description'       => 'Adidas Ultraboost 23 with BOOST midsole for incredible energy return and Primeknit upper for a sock-like fit.',
                'price'             => 190.00,
                'sale_price'        => null,
                'stock_quantity'    => 80,
                'sku'               => 'AUB23001',
                'main_image'        => 'https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => false,
                'is_best_seller'    => false,
                'rating'            => 4.7,
                'reviews_count'     => 167,
            ],
            [
                'category_id'       => 1,
                'brand_id'          => 5,
                'name'              => 'Sony WH-1000XM5',
                'slug'              => 'sony-wh-1000xm5',
                'short_description' => 'Industry-leading noise canceling headphones.',
                'description'       => 'Sony WH-1000XM5 with industry-leading noise canceling, 30-hour battery life, and multipoint connection for two devices simultaneously.',
                'price'             => 399.99,
                'sale_price'        => 349.99,
                'stock_quantity'    => 45,
                'sku'               => 'SNYWH1K5',
                'main_image'        => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => false,
                'is_best_seller'    => true,
                'rating'            => 4.9,
                'reviews_count'     => 312,
            ],
            [
                'category_id'       => 5,
                'brand_id'          => null,
                'name'              => 'Premium Skincare Set',
                'slug'              => 'premium-skincare-set',
                'short_description' => 'Complete luxury skincare routine in one set.',
                'description'       => 'Includes cleanser, toner, serum, moisturizer and SPF for complete skin protection. Suitable for all skin types.',
                'price'             => 149.99,
                'sale_price'        => 129.99,
                'stock_quantity'    => 60,
                'sku'               => 'SKS001',
                'main_image'        => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => false,
                'is_new_arrival'    => true,
                'is_best_seller'    => true,
                'rating'            => 4.4,
                'reviews_count'     => 89,
            ],
            [
                'category_id'       => 6,
                'brand_id'          => null,
                'name'              => 'The Art of War',
                'slug'              => 'the-art-of-war',
                'short_description' => 'Timeless classic by Sun Tzu.',
                'description'       => 'The ancient Chinese military treatise — essential reading for strategy and leadership. This edition includes modern commentary and applications.',
                'price'             => 12.99,
                'sale_price'        => null,
                'stock_quantity'    => 200,
                'sku'               => 'BK001',
                'main_image'        => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => false,
                'is_new_arrival'    => false,
                'is_best_seller'    => true,
                'rating'            => 4.8,
                'reviews_count'     => 528,
            ],
            [
                'category_id'       => 1,
                'brand_id'          => 6,
                'name'              => 'LG OLED 4K TV 55"',
                'slug'              => 'lg-oled-4k-tv-55',
                'short_description' => 'Stunning OLED display with perfect blacks.',
                'description'       => 'LG 55-inch OLED 4K Smart TV with α9 AI Processor 4K, Dolby Vision IQ, and webOS. Experience cinema-quality visuals at home.',
                'price'             => 1499.99,
                'sale_price'        => 1299.99,
                'stock_quantity'    => 20,
                'sku'               => 'LGOLED55',
                'main_image'        => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829e1?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.6,
                'reviews_count'     => 74,
            ],
            [
                'category_id'       => 2,
                'brand_id'          => 3,
                'name'              => 'Nike Dri-FIT T-Shirt',
                'slug'              => 'nike-dri-fit-t-shirt',
                'short_description' => 'Lightweight and breathable training shirt.',
                'description'       => 'Nike Dri-FIT technology moves sweat away from your skin to help you stay dry and comfortable during your workout.',
                'price'             => 35.00,
                'sale_price'        => 28.99,
                'stock_quantity'    => 150,
                'sku'               => 'NKDFT001',
                'main_image'        => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => false,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.3,
                'reviews_count'     => 56,
            ],
            [
                'category_id'       => 3,
                'brand_id'          => null,
                'name'              => 'Minimalist Desk Lamp',
                'slug'              => 'minimalist-desk-lamp',
                'short_description' => 'Elegant LED desk lamp with wireless charging.',
                'description'       => 'Beautifully designed LED desk lamp with built-in wireless charging pad, 3 color temperatures, and adjustable brightness.',
                'price'             => 79.99,
                'sale_price'        => null,
                'stock_quantity'    => 40,
                'sku'               => 'LAMP001',
                'main_image'        => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.5,
                'reviews_count'     => 32,
            ],
            [
                'category_id'       => 5,
                'brand_id'          => null,
                'name'              => 'Luxury Perfume Gift Set',
                'slug'              => 'luxury-perfume-gift-set',
                'short_description' => 'Exclusive fragrance collection in a premium gift box.',
                'description'       => 'A curated collection of 5 premium fragrances in a luxury gift box. Perfect for gifting or treating yourself.',
                'price'             => 199.99,
                'sale_price'        => 169.99,
                'stock_quantity'    => 30,
                'sku'               => 'PERF001',
                'main_image'        => 'https://images.unsplash.com/photo-1541643600914-78b084683702?w=600&h=600&fit=crop',
                'is_active'         => true,
                'is_featured'       => true,
                'is_new_arrival'    => true,
                'is_best_seller'    => false,
                'rating'            => 4.7,
                'reviews_count'     => 61,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // ── Banners (with real Unsplash images) ─────────────────────────
        $banners = [
            [
                'title'       => 'New Season Collection',
                'subtitle'    => 'Summer 2024',
                'description' => 'Discover the latest trends with up to 40% off on selected items.',
                'image'       => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1920&h=800&fit=crop',
                'button_text' => 'Shop Now',
                'button_link' => '/shop',
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Premium Electronics',
                'subtitle'    => 'Top Brands',
                'description' => 'Get the latest gadgets from Apple, Samsung, Sony and more.',
                'image'       => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=1920&h=800&fit=crop',
                'button_text' => 'Explore',
                'button_link' => '/shop?category=electronics',
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Exclusive Deals',
                'subtitle'    => 'Limited Time Only',
                'description' => 'Shop our exclusive deals and save big on fashion, home, and more.',
                'image'       => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1920&h=800&fit=crop',
                'button_text' => 'View Deals',
                'button_link' => '/shop',
                'is_active'   => true,
                'sort_order'  => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}