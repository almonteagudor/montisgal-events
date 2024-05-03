using Microsoft.AspNetCore.Mvc;

namespace montisgal_events.Controllers;

[Route("groups")]
public class GroupController: Controller
{
    public IActionResult Index()
    {
        return View();
    }
}