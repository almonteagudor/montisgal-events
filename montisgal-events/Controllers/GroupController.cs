using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using montisgal_events.Business.UseCases.Group;
using montisgal_events.Models.Group;

namespace montisgal_events.Controllers;

[Authorize]
[Route("groups")]
public class GroupController(AddGroupUseCase addGroupUseCase, GetGroupsUseCase getGroupsUseCase, DeleteGroupUseCase deleteGroupUseCase) : Controller
{
    [HttpGet("")]
    public async Task<IActionResult> Index()
    {
        var groupList = await getGroupsUseCase.Execute();
        
        return View(new IndexViewModel()
        {
            Groups = groupList
        });
    }

    [HttpGet("create")]
    public IActionResult Create()
    {
        return View();
    }

    [HttpPost("create")]
    public async Task<IActionResult> AddGroupToDatabase(CreateViewModel request)
    {
        var isCreated = await addGroupUseCase.Execute(request.Name, request.Description, request.IsPublic);

        return RedirectToAction("Index");
    }

    [HttpDelete("/{id}")]
    public async Task<IActionResult> Delete(Guid id)
    {
        var isDeleted = await deleteGroupUseCase.Execute(id);
        return RedirectToAction("Index");
    }
}