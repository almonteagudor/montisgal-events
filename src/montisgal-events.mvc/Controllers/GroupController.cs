using System.Security.Claims;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using montisgal_events.application.Groups;
using montisgal_events.domain.Shared.Exceptions;
using montisgal_events.mvc.Models.Groups;

namespace montisgal_events.mvc.Controllers;

[Authorize]
[Route("groups")]
public class GroupController(IHttpContextAccessor contextAccessor) : Controller
{
    [HttpGet("")]
    public async Task<IActionResult> Index([FromServices] GetGroupsUseCase useCase)
    {
        var ownerId = Guid.Parse(contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value);

        var groupList = await useCase.Execute(ownerId);

        return View(new IndexViewModel(groupList) { Groups = groupList });
    }

    [HttpGet("create")]
    public IActionResult Create()
    {
        return View(new CreateViewModel());
    }

    [HttpPost("create")]
    public async Task<IActionResult> AddGroupToDatabase(
        CreateViewModel createViewModel,
        [FromServices] CreateGroupUseCase createGroupUseCase
    )
    {
        var ownerId = Guid.Parse(contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value);

        try
        {
            var group = await createGroupUseCase.Execute(createViewModel.Name, createViewModel.Description, createViewModel.IsPublic, ownerId);
            
            if(group is not null) return RedirectToAction("Index");

            createViewModel.GeneralError = "An error has occurred.";
            
            return View("Create", createViewModel);
        }
        catch (DomainValidationException e)
        {
            createViewModel.NameError = e.Errors.TryGetValue("name", out var name) ? name : null;
            createViewModel.DescriptionError = e.Errors.TryGetValue("description", out var description) ? description : null;
            createViewModel.IsPublicError = e.Errors.TryGetValue("isPublic", out var isPublic) ? isPublic : null;
            
            return View("Create", createViewModel);
        }
    }
    //
    // [HttpGet("update/{id:guid}")]
    // public async Task<IActionResult> Update(Guid id)
    // {
    //     var groupEntity = getGroupUseCase.Execute(id);
    //
    //     return RedirectToAction("Index");
    // }
    //
    // [HttpPost("update/{id:guid}")]
    // public async Task<IActionResult> Update(Guid id, EditViewModel request)
    // {
    //     var isUpdated = await updateGroupUseCase.Execute(id, request.Name, request.Description, request.IsPublic);
    //
    //     return RedirectToAction("Index");
    // }
    //
    // [HttpPost("/{id:guid}")]
    // public async Task<IActionResult> Delete(Guid id)
    // {
    //     var isDeleted = await deleteGroupUseCase.Execute(id);
    //     return RedirectToAction("Index");
    // }
}