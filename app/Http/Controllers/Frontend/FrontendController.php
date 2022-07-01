<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMailNotifiable;
use App\Mail\SendContactInfo;
use App\Models\Album\Album;
use App\Models\Menu\Menu;
use App\Models\Menu\SubMenu;
use App\Models\Client\Client;
use App\Models\Document\Document;
use App\Models\Event\Event;
use App\Models\Gallery\Gallery;
use App\Models\Team\Team;
use App\Models\Page\Page;
use App\Models\Project\Project;
use App\Models\Sector\Sector;
use App\Models\Slider\Slider;
use App\Models\Timeline\Timeline;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{


    public function homepage()
    {
        $projects = Project::where('is_published', 1)->where('is_featured', 1)->get();

        $hydropower = Project::where('sector_id', 25)->where('is_featured', 1)->latest()->take(3)->get();
        $construction = Project::where('sector_id', 29)->where('is_featured', 1)->latest()->take(3)->get();

        $sectors = Sector::where('is_published', 1)->where('is_featured', 1)->get();
        $albums = Album::where('is_featured', 1)->where('is_published', 1)->get();
        $clients = Client::where('is_featured', 1)->where('is_published', 1)->get();
        
        $sliders = Slider::where('is_published',0)->get();
        $menus = Menu::where('is_published',0)->get();
        $documents = Document::where('is_published', 1)->get();
        $timelines = Timeline::where('is_published', 1)->orderBy('timeline_date','asc')->get();
        return view('frontend.home', compact( 'menus','sectors','sliders', 'documents', 'projects', 'clients', 'albums', 'timelines','hydropower','construction'));
    }

    public function page($slug = null)
    {
        
        if ($slug) {
            
            $page = Page::whereSlug($slug)->whereIsPublished(1)->first();

            if ($page == null) {
                return view('frontend.errors.404');
            }

            if ($page) {
                $pages = Page::whereIsPublished(1)->whereIsPrimary(0)->whereNotIn('id', [$page->id])->take(10)->inRandomOrder()->get();
                if ($pages) {
                    return view('frontend.page', compact('page', 'pages'));
                }
            } else {
                return view('frontend.errors.404');
            }
        }
    }
    public function about(Sector $sectors, Project $projects)
    {
        $projectses = Project::where('is_published', 1)->take(3)->get();
        $sectors = Sector::where('is_published', 1)->take(3)->get();
        $about = Page::where('title','about')->first();
        return view('frontend.about.about', compact('about','sectors','projectses'));
    }

    public function bod()
    {
        $bod = Team::whereIsPublished(1)->where('view', 'bod')->orderBy('order', 'asc')->get();
        $bod = $bod->groupBy('rank');
        
        return view('frontend.about.boardofdirector', compact('bod'));
    }

    public function chairman()
    {
        $chairman = Team::whereIsPublished(1)->where('view', 'chairman')->orderBy('order', 'asc')->get();
        $chairman = $chairman->groupBy('rank');
        $founder = Team::whereIsPublished(1)->where('view', 'founder')->get();
        $founder = $founder->groupBy('rank');
        
        return view('frontend.about.chairman', compact('chairman','founder'));
    }

    

    public function groupHydro()
    {
        $hydro = Team::whereIsPublished(1)->where('view','group')->where('sector', 'hydropower')->orderBy('order', 'asc')->get();

        $hydro = $hydro->groupBy('rank');
        
        return view('frontend.about.group.hydropower', compact('hydro'));
    }

    public function groupConstruction()
    {
        $construction = Team::whereIsPublished(1)->where('view','group')->where('sector', 'construction')->orderBy('order', 'asc')->get();

        $construction = $construction->groupBy('rank');
     
        return view('frontend.about.group.construction', compact('construction'));
    }

    public function groupHimshree()
    {
        $himshree = Team::whereIsPublished(1)->where('view','group')->where('sector', 'himshree')->orderBy('order', 'asc')->get();

        $himshree = $himshree->groupBy('rank');
     
        return view('frontend.about.group.himshree', compact('himshree'));
    }

    public function managementHydro()
    {
        $hydro = Team::whereIsPublished(1)->where('view','management')->where('sector', 'hydropower')->orderBy('order', 'asc')->get();

        $hydro = $hydro->groupBy('rank');
        
        return view('frontend.about.management.hydropower', compact('hydro'));
    }

    public function managementConstruction()
    {
        $construction = Team::whereIsPublished(1)->where('view','management')->where('sector', 'construction')->orderBy('order', 'asc')->get();

        $construction = $construction->groupBy('rank');
     
        return view('frontend.about.management.construction', compact('construction'));
    }

    public function managementHimshree()
    {
        $himshree = Team::whereIsPublished(1)->where('view','management')->where('sector', 'himshree')->orderBy('order', 'asc')->get();

        $himshree = $himshree->groupBy('rank');
     
        return view('frontend.about.management.himshree', compact('himshree'));
    }
   

    public function searchResult(Request $request){
      
        
        $search_title = $request->keyword;
        if(isset($request->keyword) && !empty($request->keyword)){
            $project = Project::where('title','LIKE',"%".$request->keyword."%")
                        ->orWhere('content','LIKE',"%".$request->keyword."%")->get();
            //dd($project);
            return view('frontend.project.projectsearch', compact('project','search_title'));
        }
        
    }
    public function projectsList()
    {
        $projects = Project::where('is_published', 1)->latest()->get();
        $hydropower = Project::where('sector_id', 25)->get();
        $construction = Project::where('sector_id', 29)->get();
        return view('frontend.project.index', compact('projects','hydropower','construction'));
    }

   

    public function projectsDetail(Project $projects){
        $hydropower = Project::where('sector_id', 25)->get();
        $construction = Project::where('sector_id', 29)->get();
        $sectors = Sector::where('is_published', 1)->take(3)->get();
        $projectses = Project::where('is_published', 1)->take(2)->get();
        return view('frontend.project.detail', compact('projects','projectses','construction','hydropower','sectors'));

    }

    public function gallery()
    {
        // $albums = Album::where('is_published', 1)->latest()->get();
        $galleries = Gallery::where('is_published', 1)->latest()->get();
        return view('frontend.gallery.index', compact('galleries'));
    }

    public function sectorsList()
    {
        $sectors = Sector::where('is_published', 1)->get();
        return view('frontend.sector.index', compact('sectors'));
    }

    public function sectorsDetail(Sector $sectors, Client $clients, Project $projects)
    {
        $projects = Project::where('is_published', 1)->where('sector_id',$sectors->id)->get();
        $clients = Client::where('is_published', 1)->where('sector_id',$sectors->id)->get();
        return view('frontend.sector.detail', compact('sectors', 'clients','projects'));
    }

    public function timelime(Timeline $timelines)
    {
        $timelineses = Timeline::where('is_published', 1)->whereNotIn('id', [$timelines->id])->get();
        return view('frontend.timelime.timeline' , compact('timelines', 'timelineses'));
    }

    public function downloads()
    {
        $downloads = Document::where('is_published', 1)->orderBy('created_at', 'desc')->get();
        return view('frontend.download.index', compact('downloads'));
    }

    public function contact()
    {
        return view('frontend.contact.contact');
    }

    
    public function faq()
    {
        return view('frontend.faq');
    }


    public function sendcontact(Request $request)
    {
        $data = $request->all();
        //dd($request->all());
        Mail::to('ritu.gubhaju20@gmail.com')->send(new SendContactInfo($data));
        return redirect()->back()->withSuccess(trans('Contact Inquiry Send Successfully'));
    }

    public function teams($team = null)
    {

        $teams = Team::whereIsPublished(1)->where('view', 'our-team')->orderBy('order', 'asc')->get();
        $bod = Team::whereIsPublished(1)->where('view', 'bod')->orderBy('order', 'asc')->get();
        $chairman = Team::whereIsPublished(1)->where('view', 'chairman')->orderBy('order', 'asc')->get();
        $founder = Team::whereIsPublished(1)->where('view', 'founder')->orderBy('order', 'asc')->get();
        $bod = $bod->groupBy('rank');
        $founder = $founder->groupBy('rank');
        $chairman = $chairman->groupBy('rank');
        $teams = $teams->groupBy('rank');
        
        return view('frontend.teams.team', compact('teams','bod', 'founder','chairman'));
    }

    public function teamsDetail(Team $teams, Sector $sectors,Client $clients, Project $projects)
    {
        $projects = Project::where('is_published', 1)->where('sector_id',$sectors->id)->get();
        $clients = Client::where('is_published', 1)->where('sector_id',$sectors->id)->get();
        return view('frontend.teams.detail', compact('teams', 'clients','projects'));
    }


}
