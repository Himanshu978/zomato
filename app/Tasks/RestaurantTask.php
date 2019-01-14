<?php

namespace App\Tasks;


use App\Address;
use App\Restaurant;
use App\District;
use DB;

class RestaurantTask
{
    /**
     * @param $restaurantData
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($restaurantData)
    {

        DB::beginTransaction();
        try {

            $data = $this->setData($restaurantData);

            $restaurant = Restaurant::create($data);
            $address = Address::create([
                'street_address' => $restaurantData->street_address,
                'district_id'    => $restaurantData->district_id,
                'zip'            => $restaurantData->zip
            ]);

            $restaurant->addresses()->save($address);


            if ($restaurantData->image) {
                $this->storeImage($restaurantData->image, $restaurant);
            }

            DB::commit();

            return $restaurant;

        } catch (\Exception $ex) {
            DB::rollback();

            return response()->json(['error' => $ex->getMessage()], 500);
        }

    }

    /**
     * @param $file_data
     * @param $restaurant
     */
    private function storeImage($file_data, $restaurant)
    {
        if ($file_data != "") {

            $pos       = strpos($file_data, ';');
            $type      = explode(':', substr($file_data, 0, $pos))[1];
            $type      = explode('/', $type);
            $file_name = 'image_' . time() . '.' . 'jpg';

            $storage_path = public_path() . '/' . $file_name;

            file_put_contents($storage_path, $file_data);

            $restaurant->image()->create([
                'url' => $file_name
            ]);
        }
    }


    /**
     * @param $restaurantData
     * @param $address_id
     * @return array
     */
    public function setData($restaurantData)
    {
        return [
            'name'        => $restaurantData->name,
            'description' => $restaurantData->description,
            'phone'       => $restaurantData->phone,
            'opening'     => $restaurantData->opening,
            'closing'     => $restaurantData->closing,
            'user_id'     => $restaurantData->user_id,

        ];
    }


}
