using System.Security.Claims;
using Microsoft.EntityFrameworkCore;
using montisgal_events.Business.Dtos.Group;
using montisgal_events.Business.Mappers;
using montisgal_events.Data;

namespace montisgal_events.Business.UseCases.Group;

public class GetGroupUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<GroupDto?> Execute(Guid id)
    {
        var userId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;
        var groupEntity = await applicationDbContext.Groups.FirstOrDefaultAsync(groupEntity =>
            groupEntity.Id == id && groupEntity.OwnerId == userId);

        return groupEntity?.ToDto();
    }
}