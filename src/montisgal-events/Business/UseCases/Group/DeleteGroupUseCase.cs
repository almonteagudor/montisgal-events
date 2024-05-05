using System.Security.Claims;
using montisgal_events.Data;

namespace montisgal_events.Business.UseCases.Group;

public class DeleteGroupUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<bool> Execute(Guid groupId)
    {
        var ownerId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;

        var group = applicationDbContext.Groups.FirstOrDefault(groupEntity => groupEntity.OwnerId == ownerId && groupEntity.Id == groupId);
        
        if (group == null) { return  false; }
        
        applicationDbContext.Groups.Remove(group);
        await applicationDbContext.SaveChangesAsync();
        
        return true;
    }
}