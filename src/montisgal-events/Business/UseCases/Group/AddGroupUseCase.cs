using System.Security.Claims;
using montisgal_events.Data;
using montisgal_events.Data.Entities;

namespace montisgal_events.Business.UseCases.Group;

public class AddGroupUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<bool> Execute(string name, string description, bool isPublic)
    {
        var ownerId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;

        GroupEntity group = new(Guid.NewGuid(), name, description, isPublic, ownerId);

        var response = await applicationDbContext.Groups.AddAsync(group);
        await applicationDbContext.SaveChangesAsync();

        return true;
    }
}