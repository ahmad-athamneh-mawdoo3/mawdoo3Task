<?php

namespace mawdoo3\laravelTask\Controllers;
use Guzzle\Http\Client;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearch($searchWord='')
    {
        $cx = config('customSearch.cx');
        $key = config('customSearch.key'); 
        $ch = curl_init("https://www.googleapis.com/customsearch/v1?q=$searchWord&cx=$cx&num=10&start=1&key=$key&alt=json");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        $response =json_decode($server_output);
        if($status==200 && isset($response->items) ){
            $data =[];
            foreach ($response->items as $key => $value) {
                array_push($data,[
                    'title'=>$value->title,
                    'description'=>$value->pagemap->metatags[0]->{'og:description'},
                    'link'=>$value->link,
                    'formattedUrl'=>$value->formattedUrl,
                    'comment'=>'',
                    'isSelected'=>False,
                    'data'=>$_GET,
                ]);
            }
            return $data;

        }else{
            dump($response);
            return [];
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearchView($searchWord='')
    {

        return view('task::search',['searchData'=>$this->getSearch($searchWord),'searchWord'=>$searchWord]);
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('task::saved_results',['data'=>\mawdoo3\laravelTask\Models\SavedResult::all()]);
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setSearch(Request $request)
    {
        $data =  $request->all()['item'];
        $filtered =  array_filter($data,function($item){return isset($item['isSelected']) && $item['isSelected']=="true";});
        $filtered =array_values($filtered);
        $filtered = array_map(function($item){
            unset($item['isSelected']);
            $item['created_at'] = now();
            return $item;
        },array_values($filtered));
        \mawdoo3\laravelTask\Models\SavedResult::insert(array_values($filtered));
        return  view('task::saved_results',['data'=>\mawdoo3\laravelTask\Models\SavedResult::all()]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $result)
    {
        $result->update(['comment'=>$request->comment]);
        return redirect()->route('searchResult');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $result)
    {
        //
        $result->delete();
        return redirect()->route('searchResult');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ActionResult(Request $request,  $result)
    {
        $result =\mawdoo3\laravelTask\Models\SavedResult::find($result);
       return ($request->all()['action']=='Delete')?$this->destroy($result):$this->update($request,$result);
    }
}
