<?php

namespace App\Http\Controllers;

use App\Events\ShortUrlVisited;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShortUrlRequest;
use App\Http\Requests\UpdateShortUrlRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the per‑page value from the query string, or default to 10
        $perPage = (int) $request->input('perpage', 10);

        // Paginate with that per‑page value, preserving other query params
        $shortUrls = ShortUrl::where('user_id', Auth::id())
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('short_urls.index', compact('shortUrls', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('short_urls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShortUrlRequest $request)
    {
        ShortUrl::create([
            'user_id' => Auth::id(),
            'original_url' => $request->original_url,
            'short_code' => Str::random(6),
        ]);

        return redirect()->route('short-urls.index')->with('success', 'Short URL created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShortUrl $shortUrl)
    {
        return view('short_urls.show', compact('shortUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortUrl $shortUrl)
    {
        return view('short_urls.edit', compact('shortUrl'));
    }

    public function redirect($shortCode)
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->firstOrFail();

        event(new ShortUrlVisited($shortUrl));

        return redirect($shortUrl->original_url);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShortUrlRequest $request, ShortUrl $shortUrl)
    {
        $shortUrl->update([
            'original_url' => $request->original_url,
        ]);

        return redirect()->route('short-urls.index')->with('success', 'Short URL updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $shortUrl)
    {
        $shortUrl->delete();

        return redirect()->route('short-urls.index')->with('success', 'Short URL deleted!');
    }
}
