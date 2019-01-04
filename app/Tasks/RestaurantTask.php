<?php

namespace App\Tasks;



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
            $address_id = $this->createAddress($restaurantData->district_id, $restaurantData->street_address);

            $data = $this->setData($restaurantData, $address_id);

            $restaurant = Restaurant::create($data);

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
     * @param $district_id
     * @param $street_address
     * @return mixed
     */
    private function createAddress($district_id, $street_address)
    {
        $address = District::findOrFail($district_id)
                           ->addresses()->create([
                'street_address' => $street_address
            ]);

        return $address->id;
    }

    /**
     * @param $restaurantData
     * @param $address_id
     * @return array
     */
    public function setData($restaurantData, $address_id)
    {
        return [
            'name'        => $restaurantData->name,
            'description' => $restaurantData->description,
            'phone'       => $restaurantData->phone,
            'opening'     => $restaurantData->opening,
            'closing'     => $restaurantData->closing,
            'address_id'  => $address_id,
            'user_id'     => auth()->user()->id
        ];
    }
}
