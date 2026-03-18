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
        // Admin user
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@luxeshop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Customer user
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

        // Categories
        $categories = [
            ['name' => 'Electronics',  'slug' => 'electronics',  'description' => 'Latest electronic gadgets and devices'],
            ['name' => 'Fashion',      'slug' => 'fashion',      'description' => 'Trendy clothing and accessories'],
            ['name' => 'Home & Living','slug' => 'home-living',  'description' => 'Beautiful home decor and furniture'],
            ['name' => 'Sports',       'slug' => 'sports',       'description' => 'Sports equipment and activewear'],
            ['name' => 'Beauty',       'slug' => 'beauty',       'description' => 'Premium beauty and skincare products'],
            ['name' => 'Books',        'slug' => 'books',        'description' => 'Best books and educational materials'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Brands
        $brands = [
            ['name' => 'Apple',    'slug' => 'apple'],
            ['name' => 'Samsung',  'slug' => 'samsung'],
            ['name' => 'Nike',     'slug' => 'nike'],
            ['name' => 'Adidas',   'slug' => 'adidas'],
            ['name' => 'Sony',     'slug' => 'sony'],
            ['name' => 'LG',       'slug' => 'lg'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Products
        $products = [
            [
                'category_id'     => 1,
                'brand_id'        => 1,
                'name'            => 'iPhone 15 Pro Max',
                'slug'            => 'iphone-15-pro-max',
                'short_description' => 'The most powerful iPhone ever with titanium design.',
                'description'     => 'Experience the future with iPhone 15 Pro Max featuring A17 Pro chip, ProRAW camera system, and USB-C connectivity.',
                'price'           => 1299.99,
                'sale_price'      => 1199.99,
                'stock_quantity'  => 50,
                'sku'             => 'IPH15PM001',
                'is_featured'     => true,
                'is_new_arrival'  => true,
            ],
            [
                'category_id'     => 1,
                'brand_id'        => 2,
                'name'            => 'Samsung Galaxy S24 Ultra',
                'slug'            => 'samsung-galaxy-s24-ultra',
                'short_description' => 'The ultimate Galaxy experience with AI features.',
                'description'     => 'Samsung Galaxy S24 Ultra with 200MP camera, S Pen, and Galaxy AI.',
                'price'           => 1199.99,
                'sale_price'      => null,
                'stock_quantity'  => 35,
                'sku'             => 'SGS24U001',
                'is_featured'     => true,
                'is_best_seller'  => true,
            ],
            [
                'category_id'     => 3,
                'brand_id'        => null,
                'name'            => 'Luxury Velvet Sofa',
                'slug'            => 'luxury-velvet-sofa',
                'short_description' => 'Premium 3-seater velvet sofa for modern living.',
                'description'     => 'Handcrafted luxury velvet sofa with solid wood frame and premium foam cushions.',
                'price'           => 899.99,
                'sale_price'      => 749.99,
                'stock_quantity'  => 15,
                'sku'             => 'SOF001',
                'is_featured'     => true,
                'is_new_arrival'  => true,
            ],
            [
                'category_id'     => 4,
                'brand_id'        => 3,
                'name'            => 'Nike Air Max 270',
                'slug'            => 'nike-air-max-270',
                'short_description' => 'Maximum air cushioning for all-day comfort.',
                'description'     => 'Nike Air Max 270 with large Air unit for maximum comfort and street-ready style.',
                'price'           => 150.00,
                'sale_price'      => 119.99,
                'stock_quantity'  => 100,
                'sku'             => 'NAM270001',
                'is_best_seller'  => true,
                'is_new_arrival'  => true,
            ],
            [
                'category_id'     => 2,
                'brand_id'        => 4,
                'name'            => 'Adidas Ultraboost 23',
                'slug'            => 'adidas-ultraboost-23',
                'short_description' => 'Energy-returning running shoes.',
                'description'     => 'Adidas Ultraboost 23 with BOOST midsole for incredible energy return and Primeknit upper.',
                'price'           => 190.00,
                'sale_price'      => null,
                'stock_quantity'  => 80,
                'sku'             => 'AUB23001',
                'is_featured'     => true,
            ],
            [
                'category_id'     => 1,
                'brand_id'        => 5,
                'name'            => 'Sony WH-1000XM5',
                'slug'            => 'sony-wh-1000xm5',
                'short_description' => 'Industry-leading noise canceling headphones.',
                'description'     => 'Sony WH-1000XM5 with industry-leading noise canceling, 30-hour battery life.',
                'price'           => 399.99,
                'sale_price'      => 349.99,
                'stock_quantity'  => 45,
                'sku'             => 'SNYWH1K5',
                'is_best_seller'  => true,
                'is_featured'     => true,
            ],
            [
                'category_id'     => 5,
                'brand_id'        => null,
                'name'            => 'Premium Skincare Set',
                'slug'            => 'premium-skincare-set',
                'short_description' => 'Complete luxury skincare routine in one set.',
                'description'     => 'Includes cleanser, toner, serum, moisturizer and SPF for complete skin protection.',
                'price'           => 149.99,
                'sale_price'      => 129.99,
                'stock_quantity'  => 60,
                'sku'             => 'SKS001',
                'is_new_arrival'  => true,
                'is_best_seller'  => true,
            ],
            [
                'category_id'     => 6,
                'brand_id'        => null,
                'name'            => 'The Art of War',
                'slug'            => 'the-art-of-war',
                'short_description' => 'Timeless classic by Sun Tzu.',
                'description'     => 'The ancient Chinese military treatise — essential reading for strategy and leadership.',
                'price'           => 12.99,
                'sale_price'      => null,
                'stock_quantity'  => 200,
                'sku'             => 'BK001',
                'is_best_seller'  => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Banners
        $banners = [
            [
                'title'       => 'New Season Collection',
                'subtitle'    => 'Summer 2024',
                'description' => 'Discover the latest trends with up to 40% off on selected items.',
                'image'       => 'banners/banner1.jpg',
                'button_text' => 'Shop Now',
                'button_link' => '/shop',
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Premium Electronics',
                'subtitle'    => 'Top Brands',
                'description' => 'Get the latest gadgets from Apple, Samsung, Sony and more.',
                'image'       => 'banners/banner2.jpg',
                'button_text' => 'Explore',
                'button_link' => '/shop?category=electronics',
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Exclusive Deals',
                'subtitle'    => 'Limited Time',
                'description' => 'Shop our exclusive deals and save big on fashion, home, and more.',
                'image'       => 'banners/banner3.jpg',
                'button_text' => 'View Deals',
                'button_link' => '/shop',
                'sort_order'  => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}