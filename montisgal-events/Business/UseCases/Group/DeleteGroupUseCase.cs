using System.Security.Claims;
using montisgal_events.Data;
using montisgal_events.Data.Entities;

namespace montisgal_events.Business.UseCases.Group;

public class DeleteGroupUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<bool> Execute(Guid groupId)
    {
        var ownerId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;

        GroupEntity? group = applicationDbContext.Groups.Where(x => x.OwnerId == ownerId && x.Id == groupId).FirstOrDefault();
        if (group == null) { return  false; }
        applicationDbContext.Groups.Remove(group);
        await applicationDbContext.SaveChangesAsync();
        return true;
    }
}