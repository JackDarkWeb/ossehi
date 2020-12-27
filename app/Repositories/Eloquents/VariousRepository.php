<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Auth;
use App\Models\Various;
use App\Repositories\Contracts\VariousRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VariousRepository implements VariousRepositoryContract
{

    /**
     * @return mixed
     */
    public function getAll()
    {
        return Various::latest()->paginate(6);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getAllByType($type)
    {
        return Various::where('type', $type)->latest()->paginate(6);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return Various::with(['galleries', 'user'])
                       ->where(function (Builder $query) use ($slug){
                               $query->where('slug', $slug);
                       })->first();
    }

    /**
     * @param $type
     * @param $take
     * @return mixed
     */
    public function getByType($type, $take)
    {
        return Various::where('type', $type)
            ->take($take)
            ->latest()
            ->get();
    }

    /**
     * @param $skip
     * @param $take
     * @return Builder[]|Collection|mixed
     */
    public function getByRandomOrder($skip, $take)
    {
        return Various::with('galleries')
            ->inRandomOrder()
            ->skip($skip)
            ->take($take)
            ->latest()
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Various::with(['galleries', 'user'])
            ->where(function (Builder $query) use ($id){
                $query->where('id', $id);
            })->first();
    }

    /**
     * @param Various $various
     * @return mixed
     */
    public function getCommentsByVarious(Various $various)
    {
        return $various->comments()->with('user')
            ->latest()
            ->get()
            ->map(function ($comment){
                return (object)[
                    'body' => $comment->body,
                    'user_id' => $comment->user_id,
                    'user_name_profile' => $comment->user->user_name_profile,
                    'user_name' => $comment->user->user_name,
                    'date' => $comment->date_comment
                ];
            });
    }

    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function createCommentOnThisVarious(Various $various, $request)
    {
        return $various->comments()->create([
            'user_id' => Auth::id(),
            'body'    => $request->get('body')
        ]);
    }

    /**
     * @return mixed
     */
    public function getCounterByUser()
    {
        return $this->getAllByUser()->total();
    }

    /**
     * @return mixed
     */
    public function getAllByUser()
    {
        return Various::where('user_id', Auth::id())
            ->latest()
            ->paginate(9);
    }


    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->formatRelationQuery()->create([

            'title'       => $request->get('title'),
            'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
            'description' => $request->get('description'),
            'price'       => (float)$request->get('price'),
            'devise'      => $request->get('devise'),
            'image'       => $request->get('image'),
            'type'        => $request->get('type'),
        ]);
    }

    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function update(Various $various, $request)
    {
        return $various->update([

            'title'       => $request->get('title'),
            'slug'        => Str::slug(Str::random().'-'.$request->get('title')),
            'description' => $request->get('description'),
            'price'       => $request->get('price') ?? $various->price,
            'devise'      => $request->get('devise') ?? $various->devise,
            'image'       => $request->get('image'),
            'type'        => $request->get('type'),
        ]);
    }

    /**
     * @param Various $various
     * @param null $full_image
     * @return mixed
     */
    public function createGalleries(Various $various, $full_image = null)
    {
        return $various->galleries()->create([
            'name' => $full_image ? $full_image : $various->image
        ]);
    }

    protected function formatRelationQuery(){

        return Auth::user()->variouses();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findVariousByUser($slug)
    {
        return $this->formatRelationQuery()
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param Various $various
     * @param $request
     * @return mixed
     */
    public function updateDiscount(Various $various, $request)
    {
        return $various->update([
            'discount_price' => $request->get('discount_price')
        ]);
    }

    /**
     * @param Various $various
     * @return mixed
     */
    public function cancelDiscount(Various $various)
    {
        return $various->update([
            'discount_price' => null
        ]);
    }

    /**
     * @param Various $various
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Various $various)
    {
        File::delete($various->image);

        return $various->delete();
    }
}
