<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //insert a bunch of PC brands into the database
        $brands = [
            'cooler master',
            'corsair',
            'deepcool',
            'evga',
            'fractal design',
            'gigabyte',
            'in win',
            'nzxt',
            'manjaro',
            'phanteks',
            'raijintek',
            'silverstone',
            'thermaltake',
            'xigmatek',
            'intel',
            'amd',
            'asus',
            'gigabyte',
            'msi',
            'asrock',
            'corsair',
            'gskill',
            'hyperx',
            'kingston',
            'patriot',
            'team',
            'adata',
            'crucial',
            'seagate',
            'wd',
            'corsair',
            'evga',
            'gigabyte',
            'msi',
            'asus',
            'be quiet',
            'microsoft',
            'samsung',
            'gskill',
            'antec',
            'sandisk',
            'wd',
            'canonical',
        ];
        foreach ($brands as $brand) {
            //if the brand already exists, skip it
            if (DB::table('brands')->where('Name', $brand)->exists()) {
                continue;
            }
            DB::table('brands')->insert([
                'Name' => $brand,
            ]);
        }

        //insert parttypes into the database (this is a list of all the types of parts that can be added to a PC)
        $parttypes = [
            'case',
            'motherboard',
            'ram',
            'cpu',
            'gpu',
            'psu',
            'storage',
            'cpu cooler',
            'case cooler',
            'os',
        ];
        foreach ($parttypes as $parttype) {
            //if the parttype already exists, skip it
            if (DB::table('parttypes')->where('Name', $parttype)->exists()) {
                continue;
            }
            //if OS, set optional to true
            if ($parttype == 'OS') {
                DB::table('parttypes')->insert([
                    'Name' => $parttype,
                    'Optional' => true,
                ]);
                continue;
            }
            DB::table('parttypes')->insert([
                'Name' => $parttype,
            ]);
        }


        //insert a bunch of PC parts into the database with their respective parttypes and brands and put all their specifications in their specifications column
        $parts = [
            [
                'Name' => 'Seagate Barracuda 2TB',
                'Brand' => 'seagate',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '2TB',
                    'Form Factor' => '3.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => '64MB',
                    'RPM' => '7200',
                    'Warranty' => '2 years',
                ]),
                'Price' => 59.99,
            ],
            [
                'Name' => 'Seagate Barracuda 1TB',
                'Brand' => 'seagate',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '1TB',
                    'Form Factor' => '3.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => '64MB',
                    'RPM' => '7200',
                    'Warranty' => '2 years',
                ]),
                'Price' => 39.99,
            ],
            [
                'Name' => 'Samsung 970 EVO Plus 500GB',
                'Brand' => 'samsung',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '500GB',
                    'Form Factor' => 'M.2',
                    'Interface' => 'PCIe Gen3 x4',
                    'Cache' => '512MB',
                    'RPM' => 'N/A',
                    'Warranty' => '5 years',
                ]),
                'Price' => 99.99,
            ],
            [
                'Name' => 'Sandisk Ultra 3D 1TB',
                'Brand' => 'sandisk',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '1TB',
                    'Form Factor' => '2.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => 'N/A',
                    'RPM' => 'N/A',
                    'Warranty' => '5 years',
                ]),
                'Price' => 99.99,
            ],
            [
                'Name' => 'WD Blue 1TB',
                'Brand' => 'wd',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '1TB',
                    'Form Factor' => '3.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => '64MB',
                    'RPM' => '7200',
                    'Warranty' => '2 years',
                ]),
                'Price' => 39.99,
            ],
            [
                'Name' => 'WD Blue 500GB',
                'Brand' => 'wd',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '500GB',
                    'Form Factor' => '2.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => '64MB',
                    'RPM' => '7200',
                    'Warranty' => '2 years',
                ]),
                'Price' => 39.99,
            ],
            [
                'Name' => 'Crucial MX500 1TB',
                'Brand' => 'crucial',
                'PartType' => 'storage',
                'Specifications' => json_encode([
                    'Capacity' => '1TB',
                    'Form Factor' => '2.5"',
                    'Interface' => 'SATA 6Gb/s',
                    'Cache' => 'N/A',
                    'RPM' => 'N/A',
                    'Warranty' => '5 years',
                ]),
                'Price' => 99.99,
            ],
            [
                'Name' => 'Intel Core i7-10700K',
                'Brand' => 'intel',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Core Count' => '8',
                    'Thread Count' => '16',
                    'Base Clock' => '3.8GHz',
                    'Boost Clock' => '5.1GHz',
                    'TDP' => '125W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 359.99,
            ],
            [
                'Name' => 'Intel Core i5-10600K',
                'Brand' => 'intel',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Core Count' => '6',
                    'Thread Count' => '12',
                    'Base Clock' => '4.1GHz',
                    'Boost Clock' => '4.8GHz',
                    'TDP' => '125W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 239.99,
            ],
            [
                'Name' => 'Intel Core i9-10900K',
                'Brand' => 'intel',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Core Count' => '10',
                    'Thread Count' => '20',
                    'Base Clock' => '3.7GHz',
                    'Boost Clock' => '5.3GHz',
                    'TDP' => '125W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 499.99,
            ],
            [
                'Name' => 'AMD Ryzen 7 9700K',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '8',
                    'Thread Count' => '16',
                    'Base Clock' => '3.6GHz',
                    'Boost Clock' => '4.9GHz',
                    'TDP' => '95W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 329.99,
            ],
            [
                'Name' => 'Intel Core i5-10400F',
                'Brand' => 'intel',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Core Count' => '6',
                    'Thread Count' => '12',
                    'Base Clock' => '2.9GHz',
                    'Boost Clock' => '4.3GHz',
                    'TDP' => '65W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 199.99,
            ],
            [
                'Name' => 'AMD Ryzen 5 3600',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '6',
                    'Thread Count' => '12',
                    'Base Clock' => '3.6GHz',
                    'Boost Clock' => '4.2GHz',
                    'TDP' => '65W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 199.99,
            ],
            [
                'Name' => 'AMD Ryzen 7 3700X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '8',
                    'Thread Count' => '16',
                    'Base Clock' => '3.6GHz',
                    'Boost Clock' => '4.4GHz',
                    'TDP' => '65W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 329.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3900X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '12',
                    'Thread Count' => '24',
                    'Base Clock' => '3.8GHz',
                    'Boost Clock' => '4.6GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 499.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3950X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '16',
                    'Thread Count' => '32',
                    'Base Clock' => '3.5GHz',
                    'Boost Clock' => '4.7GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 749.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3950X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '16',
                    'Thread Count' => '32',
                    'Base Clock' => '3.5GHz',
                    'Boost Clock' => '4.7GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 749.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3950X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '16',
                    'Thread Count' => '32',
                    'Base Clock' => '3.5GHz',
                    'Boost Clock' => '4.7GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 749.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3950X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '16',
                    'Thread Count' => '32',
                    'Base Clock' => '3.5GHz',
                    'Boost Clock' => '4.7GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 749.99,
            ],
            [
                'Name' => 'AMD Ryzen 9 3950X',
                'Brand' => 'amd',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'AM4',
                    'Core Count' => '16',
                    'Thread Count' => '32',
                    'Base Clock' => '3.5GHz',
                    'Boost Clock' => '4.7GHz',
                    'TDP' => '105W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 749.99,
            ],
            [
                'Name' => 'Intel Core i3-10100F',
                'Brand' => 'intel',
                'PartType' => 'cpu',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Core Count' => '4',
                    'Thread Count' => '8',
                    'Base Clock' => '3.6GHz',
                    'Boost Clock' => '4.3GHz',
                    'TDP' => '65W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 114.99,
            ],
            [
                'Name' => 'Gigabyte GeForce GTX 1660 Super OC 6G',
                'Brand' => 'gigabyte',
                'PartType' => 'gpu',
                'Specifications' => json_encode([
                    'Memory' => '6GB GDDR6',
                    'Memory Clock' => '14000MHz',
                    'Memory Bus' => '192-bit',
                    'Core Clock' => '1530MHz',
                    'Boost Clock' => '1785MHz',
                    'TDP' => '125W',
                    'Warranty' => '3 years',
                ]),
                'Price' => 249.99,
            ],
            [
                'Name' => 'Gigabyte B460M DS3H',
                'Brand' => 'gigabyte',
                'PartType' => 'motherboard',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Chipset' => 'Intel B460',
                    'Form Factor' => 'Micro ATX',
                    'Memory' => '4x DDR4 DIMM',
                    'Memory Speed' => '2666MHz',
                    'PCIe' => '2x PCIe 3.0 x16, 1x PCIe 3.0 x1',
                    'SATA' => '6x SATA 6Gb/s',
                    'M.2' => '1x M.2',
                    'Warranty' => '3 years',
                ]),
                'Price' => 79.99,
            ],
            [
                'Name' => 'G.Skill Ripjaws V 16GB (2x8GB) DDR4-3200MHz',
                'Brand' => 'gskill',
                'PartType' => 'ram',
                'Specifications' => json_encode([
                    'Memory' => '16GB (2x8GB)',
                    'Memory Type' => 'DDR4',
                    'Memory Speed' => '3200MHz',
                    'CAS Latency' => '16',
                    'Voltage' => '1.35V',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 79.99,
            ],
            [
                'Name' => 'Corsair Vengeance LPX 16GB (2x8GB) DDR4-3200MHz',
                'Brand' => 'corsair',
                'PartType' => 'ram',
                'Specifications' => json_encode([
                    'Memory' => '16GB (2x8GB)',
                    'Memory Type' => 'DDR4',
                    'Memory Speed' => '3200MHz',
                    'CAS Latency' => '16',
                    'Voltage' => '1.35V',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 79.99,
            ],
            [
                'Name' => 'Corsair Carbide 275R',
                'Brand' => 'corsair',
                'PartType' => 'case',
                'Specifications' => json_encode([
                    'Form Factor' => 'Mid Tower',
                    'Motherboard Support' => 'ATX, Micro ATX, Mini ITX',
                    'Expansion Slots' => '7',
                    'Front Ports' => '2x USB 3.0, 1x USB 2.0, 1x Audio, 1x Mic',
                    'Warranty' => '2 years',
                ]),
                'Price' => 69.99,
            ],
            [
                'Name' => 'Cooler Master MasterLiquid ML240L RGB V2',
                'Brand' => 'cooler master',
                'PartType' => 'cpu cooler',
                'Specifications' => json_encode([
                    'Socket' => 'LGA 1200',
                    'Fan Size' => '120mm',
                    'Fan Speed' => '650-2000 RPM',
                    'Noise Level' => '6-36 dBA',
                    'Warranty' => '2 years',
                ]),
                'Price' => 69.99,
            ],
            [
                'Name' => 'Cooler Master MasterBox MB311L ARGB',
                'Brand' => 'cooler master',
                'PartType' => 'case',
                'Specifications' => json_encode([
                    'Form Factor' => 'Mid Tower',
                    'Motherboard Support' => 'ATX, Micro ATX, Mini ITX',
                    'Expansion Slots' => '7',
                    'Front Ports' => '2x USB 3.0, 1x USB 2.0, 1x Audio, 1x Mic',
                    'Warranty' => '2 years',
                ]),
                'Price' => 69.99,
            ],
            [
                'Name' => 'Corsair CX550M',
                'Brand' => 'corsair',
                'PartType' => 'psu',
                'Specifications' => json_encode([
                    'Wattage' => '550W',
                    'Modular' => 'Semi-Modular',
                    'Efficiency' => '80+ Bronze',
                    'Warranty' => '5 years',
                ]),
                'Price' => 69.99,
            ],
            [
                'Name' => 'Antec VP550P',
                'Brand' => 'antec',
                'PartType' => 'psu',
                'Specifications' => json_encode([
                    'Wattage' => '550W',
                    'Modular' => 'Semi-Modular',
                    'Efficiency' => '80+ Bronze',
                    'Warranty' => '5 years',
                ]),
                'Price' => 69.99,
            ],
            [
                'Name' => 'Corsair TX Series TX550M',
                'Brand' => 'corsair',
                'PartType' => 'psu',
                'Specifications' => json_encode([
                    'Wattage' => '550W',
                    'Modular' => 'Semi-Modular',
                    'Efficiency' => '80+ Bronze',
                    'Warranty' => '5 years',
                ]),
                'Price' => 69.99,
            ],
            [
                //add a case cooler
                'Name' => 'Cooler Master MasterFan MF120R ARGB',
                'Brand' => 'cooler master',
                'PartType' => 'case cooler',
                'Specifications' => json_encode([
                    'Fan Size' => '120mm',
                    'Fan Speed' => '650-2000 RPM',
                    'Noise Level' => '6-36 dBA',
                    'Warranty' => '2 years',
                ]),
                'Price' => 19.99,
            ],
            //insert an OS
            [
                'Name' => 'Windows 10 Home',
                'Brand' => 'microsoft',
                'PartType' => 'os',
                'Specifications' => json_encode([
                    'Version' => '10 Home',
                    'License Type' => 'OEM',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 139.99,
            ],
            //insert another OS
            [
                'Name' => 'Windows 10 Pro',
                'Brand' => 'microsoft',
                'PartType' => 'os',
                'Specifications' => json_encode([
                    'Version' => '10 Pro',
                    'License Type' => 'OEM',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 199.99,
            ],
            //insert linux options
            [
                'Name' => 'Ubuntu 20.04',
                'Brand' => 'canonical',
                'PartType' => 'os',
                'Specifications' => json_encode([
                    'Version' => '20.04',
                    'License Type' => 'OEM',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 0,
            ],
            [
                'Name' => 'Manjaro 20.0.3',
                'Brand' => 'manjaro',
                'PartType' => 'os',
                'Specifications' => json_encode([
                    'Version' => '20.0.3',
                    'License Type' => 'OEM',
                    'Warranty' => 'Lifetime',
                ]),
                'Price' => 0,
            ]
        ];
        foreach ($parts as $part) {
            //get the brandid of the part using the brand name in the array and put it in the array
            $part['Brand'] = DB::table('brands')->where('Name', $part['Brand'])->value('BrandId');
            $brandid = $part['Brand'];

            //get the parttypeid of the part using the parttype name in the array and put it in the array
            $part['Parttype'] = DB::table('parttypes')->where('Name', $part['PartType'])->value('ParttypeId');
            $parttypeid = $part['Parttype'];

            //if the part already exists, skip it
            if (DB::table('parts')->where('Name', $part['Name'])->exists()) {
                continue;
            }
            DB::table('parts')->insert([
                'Name' => $part['Name'],
                'FKParttypeId' => $parttypeid,
                'FKBrandId' => $brandid,
                'Specifications' => $part['Specifications'],
                'price' => $part['Price'],
                'Stock' => rand(0, 10),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
